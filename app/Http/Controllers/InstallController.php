<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Rules\Banned;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;

class InstallController extends Controller
{
    function install_get()
    {
        return redirect(route('install.1'));
    }
    function install_1_get()
    {
        return view('install.1');
    }
    function install_1_post(Request $request)
    {
        $request->validate([
            'db_connection' => [
                'required',
                new Banned,
            ],
            'db_host' => [
                'required',
                new Banned,
            ],
            'db_port' => [
                'required',
                new Banned,
            ],
            'db_database' => [
                'required',
                new Banned,
            ],
            'db_username' => [
                'required',
                new Banned,
            ],
            'db_password' => [
                new Banned,
            ],
        ]);

        try
        {
            $connection = new PDO("mysql:host=$request->db_host;dbname=$request->db_database", $request->db_username, $request->db_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $request->session()->put('install', 2);

            $install_database = [
                'db_connection' => $request->db_connection,
                'db_host' => $request->db_host,
                'db_port' => $request->db_port,
                'db_database' => $request->db_database,
                'db_username' => $request->db_username,
                'db_password' => $request->db_password,
            ];

            $request->session()->put('install_database', $install_database);

            return redirect(route('install.2'));
        }
        catch (PDOException $e)
        {
            return back()->withErrors(['DB:', $e->getMessage()]);
        }

        return back();
    }
    function install_2_get()
    {
        return view('install.2');
    }
    function install_2_post(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 1;

        if($request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
        }
        else
        {
            return back()->withErrors('The passwords do not match.');
        }

        $user->save();

        // .ENV
        $renamed = rename(base_path('.env.example'), base_path('.env'));

        if (!$renamed)
        {
            abort(403);
        }

        $db = session()->get('install_database');

        env_update('DB_CONNECTION', $db['db_connection']);
        env_update('DB_HOST', $db['db_host']);
        env_update('DB_PORT', $db['db_port']);
        env_update('DB_DATABASE', $db['db_database']);
        env_update('DB_USERNAME', $db['db_username']);
        env_update('DB_PASSWORD', $db['db_password']);

        return redirect(RouteServiceProvider::HOME);
    }
}
