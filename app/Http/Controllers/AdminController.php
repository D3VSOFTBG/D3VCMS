<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard()
    {
        return view('admin.dashboard');
    }
    function users()
    {
        $users = User::orderBy('id', 'DESC')->paginate(env('PAGINATION_ADMIN'));
        $roles = Role::all();

        $data = [
            'users' => $users,
            'roles' => $roles,
        ];

        return view('admin.pages.users', $data);
    }
}
