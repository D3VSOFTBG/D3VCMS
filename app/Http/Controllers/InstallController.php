<?php

namespace App\Http\Controllers;

use App\Rules\NotNull;
use Illuminate\Http\Request;
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
                new NotNull,
            ],
            'db_host' => [
                'required',
                new NotNull,
            ],
            'db_port' => [
                'required',
                new NotNull,
            ],
            'db_database' => [
                'required',
                new NotNull,
            ],
            'db_username' => [
                'required',
                new NotNull,
            ],
            'db_password' => [
                new NotNull,
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

            Log::info($request->session()->get('install_database'));

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
    function install_2_post()
    {
        return back();
    }
}
