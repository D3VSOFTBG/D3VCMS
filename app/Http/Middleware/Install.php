<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class Install
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if(file_exists(base_path('.env.example')))
        // {
        //     return abort(403);
        // }
        if($request->session()->get('install') < 2 && Route::currentRouteName() == 'install.2')
        {
            return redirect(route('install.1'));
        }
        return $next($request);
    }
}
