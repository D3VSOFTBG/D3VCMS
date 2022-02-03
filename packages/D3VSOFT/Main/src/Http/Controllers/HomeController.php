<?php

namespace D3VSOFT\Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function home()
    {
        echo d3vcms_encrypt('123');
        echo d3vcms_decrypt('gO0phlpOhX2cYItDjatewQ==');
        // echo env('APP_KEY');
        // echo config('mail.driver');
        // set_mail_config();
        // echo config('mail.driver');
        // return view('main::home');
    }
}
