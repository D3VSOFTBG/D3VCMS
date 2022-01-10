<?php

use App\Role;
use App\Setting;
use App\User;

function d3vcms_version()
{
    return 1;
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
    if(empty($id))
    {
        return 'Member';
    }
    else
    {
        return Role::where('id', $id)->get('name')->pluck('name')->first();
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
        return 'Yes';
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
function title()
{
    return Setting::where('name', 'TITLE')->pluck('value')->first();
}
