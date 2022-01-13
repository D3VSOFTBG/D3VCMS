<?php

namespace App\Http\Controllers;

use App\Role;
use App\Rules\Banned;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mavinoo\Batch\Batch;

class AdminController extends Controller
{
    function dashboard()
    {
        return view('admin.dashboard');
    }
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
    function user_delete(Request $request)
    {
        User::findOrFail($request->id)->delete();
        return back();
    }
    function user_edit(Request $request)
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
    function user_create(Request $request)
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
        $settings_old = Setting::all();

        $settings = [];

        foreach($settings_old as $setting)
        {
            $settings[$setting['name']] = $setting['value'];
        }

        $data = [
            'settings' => $settings,
        ];

        return view('admin.pages.settings', $data);
    }
    function settings_post(Request $request)
    {
        // General
        $request->validate([
            'title' => [
                'required',
                new Banned,
            ],
            'title_seperator' => [
                'required',
                new Banned,
            ],
        ]);

        $setting = new Setting();

        $setting_values = [
            [
                'name' => 'TITLE',
                'value' => $request->title,
            ],
            [
                'name' => 'TITLE_SEPERATOR',
                'value' => $request->title_seperator,
            ],
        ];

        $setting_index = 'name';

        // Images
        if(isset($request->favicon))
        {
            $request->validate([
                'favicon' => 'required|image|max:2048',
            ]);

            // image
            $new_image_name = md5(uniqid(rand(), true)) . '.' . $request->favicon->extension();
            $request->favicon->move(public_path('/storage/img/global/'), $new_image_name);

            $array_push = [
                'name' => 'FAVICON',
                'value' => $new_image_name,
            ];

            array_push($setting_values, $array_push);
        }
        if(isset($request->logo))
        {
            $request->validate([
                'logo' => 'required|image|max:2048',
            ]);
            // image
            $new_image_name = md5(uniqid(rand(), true)) . '.' . $request->logo->extension();
            $request->logo->move(public_path('/storage/img/global/'), $new_image_name);

            $array_push = [
                'name' => 'LOGO',
                'value' => $new_image_name,
            ];

            array_push($setting_values, $array_push);
        }

        batch()->update($setting, $setting_values, $setting_index);

        // Mail
        $request->validate([
            'mail_driver' => [
                'required',
                new Banned,
            ],
            'mail_host' => [
                'required',
                new Banned,
            ],
            'mail_port' => [
                'required',
                new Banned,
            ],
            'mail_username' => [
                'required',
                new Banned,
            ],
            'mail_password' => [
                'required',
                new Banned,
            ],
            'mail_encryption' => [
                'required',
                new Banned,
            ],
            'mail_from_address' => [
                'required',
                new Banned,
            ],
        ]);
        if($request->mail_driver != env('MAIL_DRIVER'))
        {
            $drivers = [
                'smtp',
                'sendmail',
                'mailgun',
                'ses',
                'log',
                'array',
            ];
            if(in_array($request->mail_driver, $drivers))
            {
                env_update('MAIL_DRIVER', $request->mail_driver);
            }
            else
            {
                abort(403);
            }
        }
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
            if(filter_var($request->mail_from_address, FILTER_VALIDATE_EMAIL))
            {
                env_update('MAIL_FROM_ADDRESS', $request->mail_from_address);
            }
            else
            {
                abort(403);
            }
        }

        Artisan::call('cache:clear');
        Cache::flush();

        return back();
    }
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
    function cache_get()
    {
        return view('admin.pages.cache');
    }
    function cache_post()
    {
        Artisan::call('optimize:clear');
        Cache::flush();
        return back();
    }
}
