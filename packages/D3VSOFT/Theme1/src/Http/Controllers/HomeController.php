<?php

namespace D3VSOFT\Theme1\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('theme1::home');
    }
}
