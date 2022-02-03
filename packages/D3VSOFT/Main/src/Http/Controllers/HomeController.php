<?php

namespace D3VSOFT\Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function home()
    {
        return view('main::home');
    }
}
