<?php

use App\User;

function d3vcms_version()
{
    return 1;
}
function user_count()
{
    return User::count();
}
