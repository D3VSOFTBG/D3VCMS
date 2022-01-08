<?php

namespace App\Http\Controllers;

use App\Rules\NotNull;
use Illuminate\Http\Request;

class InstallController extends Controller
{
    function install_get()
    {
        return redirect(route('install_1'));
    }
    function install_1_get()
    {
        return view('install.1');
    }
    function install_post(Request $request)
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
                'required',
                new NotNull,
            ],
        ]);
        return back();
    }
}
