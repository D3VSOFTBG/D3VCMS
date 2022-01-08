<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    function user_delete(Request $request)
    {
        User::findOrFail($request->id)->delete();
        return back();
    }
    function user_edit(Request $request)
    {
        $user = User::findOrFail($request->id);

        $request->validate([
            'name' => 'required',
            'role' => 'required|integer',
        ]);

        $user->name = $request->name;

        if($request->email != $user->email)
        {
            $request->validate([
                'email' => 'required|email|unique:users',
            ]);
            $user->email = $request->email;
        }

        if($request->role == 0)
        {
            $user->role = NULL;
        }
        else
        {
            Role::findOrFail($request->role);
            $user->role = $request->role;
        }

        if(!empty($request->password) && !empty($request->password_confirmation))
        {
            if($request->password == $request->password_confirmation)
            {
                $user->password = Hash::make($request->password);
            }
            else
            {
                return back()->withErrors('The passwords do not match.');
            }
        }

        $user->save();

        return back();
    }
}
