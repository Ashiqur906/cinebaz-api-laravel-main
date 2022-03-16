<?php

namespace Cinebaz\Setting;


use Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'setting');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // $this->publishes([
        //     __DIR__ . '/views' => resource_path('views/vendor/setting')
        // ]);

        $this->publishes([
            __DIR__ . '/config/cz_setting.php' => config_path('cz_setting.php')
        ]);

        if (file_exists($file =  __DIR__ . '/Helpers/helpers.php')) {
            require $file;
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/cz_setting.php', 'cz_setting');
    }
}
