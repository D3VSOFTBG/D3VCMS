<?php

use App\Role;
use App\User;

function d3vcms_version()
{
    return 1 . ' Development';
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
