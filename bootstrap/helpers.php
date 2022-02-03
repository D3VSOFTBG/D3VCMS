<?php

use App\AdminMenu;
use App\Role;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

function d3vcms_version()
{
    return 1.4;
}
function user_count()
{
    return User::count();
}
function developer()
{
    return 'https://d3vsoft.com';
}
function role_name($id)
{
    if(Cache::has('ROLES'))
    {
        if(empty(Cache::get('ROLES')[$id - 1]->name))
        {
            return 'Member';
        }
        else
        {
            return Cache::get('ROLES')[$id - 1]->name;
        }
    }
    else
    {
        Cache::forever('ROLES', Role::all());
    }
}
function email_verified_at($date)
{
    if(empty($date))
    {
        return 'No';
    }
    else
    {
        return $date;
    }
}
function package_path()
{
    return base_path() . '/packages';
}
function env_update($key, $value)
{
    $path = base_path('.env');

    if (file_exists($path))
    {
        file_put_contents($path, str_replace(
            $key . '=' . '"' . env($key) . '"', $key . '=' . '"' .$value. '"', file_get_contents($path)
        ));
    }
}
function setting($name)
{
    if (Cache::has($name))
    {
        return Cache::get($name);
    }
    else
    {
        Cache::forever($name, Setting::where('name', $name)->pluck('value')->first());
        return Cache::get($name);
    }
}
function admin_menus()
{
    return AdminMenu::all();
}
function upload_path($path)
{
    return storage_path('app/public' . $path);
}
function set_mail_config()
{
    $set_mail_config = [
        'driver' => setting('MAIL_DRIVER'),
        'host' => setting('MAIL_HOST'),
        'port' => setting('MAIL_PORT'),
        'from' => [
            'address' => setting('MAIL_FROM_ADDRESS'),
            'name' => setting('TITLE'),
        ],
        'encryption' => setting('MAIL_ENCRYPTION'),
        'username' => setting('MAIL_USERNAME'),
        'password' => d3vcms_decrypt(setting('MAIL_PASSWORD')),
    ];

    Config::set('mail', $set_mail_config);
}
function d3vcms_encrypt($unencrypted_password)
{
    // Store the cipher method
    $ciphering = "AES-256-CBC";

    // Use OpenSSL Encryption method
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = config('d3vcms.iv');

    // Store the encryption key
    $encryption_key = config('app.key');

    return openssl_encrypt($unencrypted_password, $ciphering, $encryption_key, $options, $encryption_iv);
}
function d3vcms_decrypt($encrypted_password)
{
    // Store the cipher method
    $ciphering = "AES-256-CBC";

    // Use OpenSSL Encryption method
    $options = 0;

    // Non-NULL Initialization Vector for decryption
    $decryption_iv = config('d3vcms.iv');

    // Store the decryption key
    $decryption_key = config('app.key');

    return openssl_decrypt($encrypted_password, $ciphering, $decryption_key, $options, $decryption_iv);
}
