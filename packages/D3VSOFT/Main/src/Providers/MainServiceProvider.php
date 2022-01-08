<?php

namespace D3VSOFT\Main\Providers;

use Illuminate\Support\ServiceProvider;

class MainServiceProvider extends ServiceProvider
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
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'main');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'main');

        $this->publishes([
            __DIR__.'/../public' => public_path('/d3vsoft/main'),
        ]);

        $theme_path = '/d3vsoft/main';

        view()->share('theme_path', $theme_path);
    }
}
