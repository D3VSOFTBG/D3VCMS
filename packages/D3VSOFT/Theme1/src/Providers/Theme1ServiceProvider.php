<?php

namespace D3VSOFT\Theme1\Providers;

use Illuminate\Support\ServiceProvider;

class Theme1ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'theme1');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'theme1');

        $this->publishes([
            __DIR__.'/../public' => public_path('/d3vsoft/theme1'),
        ]);

        $theme_path = '/d3vsoft/theme1';

        view()->share('theme_path', $theme_path);
    }
}
