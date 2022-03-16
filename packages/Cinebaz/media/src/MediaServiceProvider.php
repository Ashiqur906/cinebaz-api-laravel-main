<?php

namespace Cinebaz\Media;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'media');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/media')
        ]);

        $this->publishes([
            __DIR__ . '/config/cz_media.php' => config_path('cz_media.php')
        ]);

        if (file_exists($file =  __DIR__ . '/Helpers/helpers.php')) {
            require $file;
        }
    }


    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/cz_media.php', 'cz_media');
    }
}
