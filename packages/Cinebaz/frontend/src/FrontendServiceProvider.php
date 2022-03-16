<?php

namespace Cinebaz\Frontend;


use Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'frontend');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // $this->publishes([
        //     __DIR__ . '/views' => resource_path('views/vendor/frontend')
        // ]);

        if (file_exists($file =  __DIR__ . '/Helpers/helpers.php')) {
            require $file;
        }
    }
}
