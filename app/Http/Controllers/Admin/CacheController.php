<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    function get()
    {
        return view('admin.pages.cache');
    }
    function post()
    {
        Artisan::call('optimize:clear');
        Cache::flush();
        return back();
    }
}
