<?php

namespace App\Http\Controllers;

use App\Rules\NotNull;
use Illuminate\Http\Request;
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
        }
        catch (PDOException $e)
        {
            return back()->withErrors(['Connection', $e->getMessage()]);
        }

        return back();
    }
}
