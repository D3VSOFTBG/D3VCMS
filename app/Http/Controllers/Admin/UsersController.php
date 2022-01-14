<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    function users()
    {
        $users = User::orderBy('id', 'DESC')->paginate(setting('PAGINATION_ADMIN'));

        if(Cache::has('ROLES'))
        {
            $roles = Cache::get('ROLES');
        }
        else
        {
            Cache::forever('ROLES', Role::all());
            $roles = Cache::get('ROLES');
        }

        $data = [
            'users' => $users,
            'roles' => $roles,
        ];

        return view('admin.pages.users', $data);
    }
    function delete(Request $request)
    {
        User::findOrFail($request->id)->delete();
        return back();
    }
    function edit(Request $request)
    {
        $user = User::findOrFail($request->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|integer',
        ]);

        $user->name = $request->name;

        if($request->email != $user->email)
        {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
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

        if(isset($request->password) && isset($request->password_confirmation))
        {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ]);
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
    function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->role == 0)
        {
            $user->role = NULL;
        }
        else
        {
            Role::findOrFail($request->role);
            $user->role = $request->role;
        }

        if($request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
        }
        else
        {
            return back()->withErrors('The passwords do not match.');
        }

        $user->save();

        return back();
    }
}
