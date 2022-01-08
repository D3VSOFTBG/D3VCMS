<?php

namespace App\Http\Controllers;

use App\Role;
use App\Rules\NotNull;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
    function user_create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required',
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
    function packages()
    {
        $vendors = glob(package_path() . '/*' , GLOB_ONLYDIR);

        $packages = [];

        foreach($vendors as $vendor)
        {
            $package = [
                'vendor' => basename($vendor),
                'package' => basename(glob($vendor . '/*' , GLOB_ONLYDIR)[0]),
            ];

            array_push($packages, $package);
        }

        $data = [
            'packages' => $packages,
        ];

        return view('admin.pages.packages', $data);
    }
    function settings_get()
    {
        $data = [];

        return view('admin.pages.settings', $data);
    }
    function settings_post(Request $request)
    {
        // General
        $request->validate([
            'title' => [
                'required',
                new NotNull,
            ],
            'app_url' => [
                'required',
                new NotNull,
            ],
            'title_seperator' => [
                'required',
                new NotNull,
            ],
            'app_env' => [
                'required',
                new NotNull,
            ],
        ]);
        if($request->title != env('TITLE'))
        {
            env_update('TITLE', $request->title);
        }
        if($request->app_url != env('APP_URL'))
        {
            env_update('APP_URL', $request->app_url);
        }
        if($request->title_seperator != env('TITLE_SEPERATOR'))
        {
            env_update('TITLE_SEPERATOR', $request->title_seperator);
        }
        if($request->app_env != env('APP_ENV'))
        {
            env_update('APP_ENV', $request->app_env);
        }
        // Mail
        $request->validate([
            'mail_driver' => [
                'required',
                new NotNull,
            ],
            'mail_host' => [
                'required',
                new NotNull,
            ],
            'mail_port' => [
                'required',
                new NotNull,
            ],
            'mail_username' => [
                'required',
                new NotNull,
            ],
            'mail_password' => [
                'required',
                new NotNull,
            ],
            'mail_encryption' => [
                'required',
                new NotNull,
            ],
            'mail_from_address' => [
                'required',
                new NotNull,
            ],
        ]);
        if($request->mail_host != env('MAIL_HOST'))
        {
            env_update('MAIL_HOST', $request->mail_host);
        }
        if($request->mail_port != env('MAIL_PORT'))
        {
            env_update('MAIL_PORT', $request->mail_port);
        }
        if($request->mail_username != env('MAIL_USERNAME'))
        {
            env_update('MAIL_USERNAME', $request->mail_username);
        }
        if($request->mail_password != env('MAIL_PASSWORD'))
        {
            env_update('MAIL_PASSWORD', $request->mail_password);
        }
        if($request->mail_encryption != env('MAIL_ENCRYPTION'))
        {
            env_update('MAIL_ENCRYPTION', $request->mail_encryption);
        }
        if($request->mail_from_address != env('MAIL_ENCRYPTION'))
        {
            env_update('MAIL_FROM_ADDRESS', $request->mail_from_address);
        }
        // Images
        if(isset($request->favicon))
        {
            $request->validate([
                'favicon' => [
                    'required|image|max:2048',
                    new NotNull,
                ],
            ]);
            // image
            $new_image_name = md5(uniqid(rand(), true)) . '.' . $request->favicon->extension();
            $request->favicon->move(public_path('/storage/img/global/'), $new_image_name);
            env_update('FAVICON', $new_image_name);
        }
        if(isset($request->logo))
        {
            $request->validate([
                'logo' => [
                    'required|image|max:2048',
                    new NotNull,
                ],
            ]);
            // image
            $new_image_name = md5(uniqid(rand(), true)) . '.' . $request->logo->extension();
            $request->logo->move(public_path('/storage/img/global/'), $new_image_name);
            env_update('LOGO', $new_image_name);
        }

        Artisan::call('cache:clear');
        Cache::flush();

        return back();
    }
}
