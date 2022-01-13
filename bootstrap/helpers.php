<?php

use App\AdminMenu;
use App\Role;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

function d3vcms_version()
{
    return 1.1;
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
