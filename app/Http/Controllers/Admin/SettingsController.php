<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\Banned;
use App\Rules\TrueOrFalse;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    function get()
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
    function post(Request $request)
    {
        // General
        $request->validate([
            'title' => 'required',
            'title_seperator' => 'required',
            'user_registration' => [
                'required',
                new TrueOrFalse,
            ],
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required|email',
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
            [
                'name' => 'USER_REGISTRATION',
                'value' => $request->user_registration,
            ],
            [
                'name' => 'MAIL_HOST',
                'value' => $request->mail_host,
            ],
            [
                'name' => 'MAIL_PORT',
                'value' => $request->mail_port,
            ],
            [
                'name' => 'MAIL_USERNAME',
                'value' => $request->mail_username,
            ],

            [
                'name' => 'MAIL_ENCRYPTION',
                'value' => $request->mail_encryption,
            ],
            [
                'name' => 'MAIL_FROM_ADDRESS',
                'value' => $request->mail_from_address,
            ],
        ];

        // MAIL PASSWORD
        if(isset($request->mail_password))
        {
            $mail_password = [
                'name' => 'MAIL_PASSWORD',
                'value' => d3vcms_encrypt($request->mail_password),
            ];
            array_push($setting_values, $mail_password);
        }

        // MAIL DRIVER
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
            $mail_driver = [
                'name' => 'MAIL_DRIVER',
                'value' => $request->mail_driver,
            ];
            array_push($setting_values, $mail_driver);
        }
        else
        {
            abort(403);
        }

        // Log::info($setting_values);

        $setting_index = 'name';

        // Images
        if(isset($request->favicon))
        {
            $request->validate([
                'favicon' => 'required|image|max:2048',
            ]);

            // image
            $new_image_name = md5(uniqid(rand(), true)) . '.' . $request->favicon->extension();
            $request->favicon->move(upload_path('/img/global/'), $new_image_name);

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
            $request->logo->move(upload_path('/img/global/'), $new_image_name);

            $array_push = [
                'name' => 'LOGO',
                'value' => $new_image_name,
            ];

            array_push($setting_values, $array_push);
        }

        batch()->update($setting, $setting_values, $setting_index);

        Cache::flush();

        return back();
    }
}
