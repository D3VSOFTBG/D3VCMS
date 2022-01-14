<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function profile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $user->name = $request->name;

        if($request->email != $user->email)
        {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
            ]);
            $user->email = $request->email;
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
}
