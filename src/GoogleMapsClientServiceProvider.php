<?php

namespace EliPett\GoogleMapsClient;

use Illuminate\Support\ServiceProvider;

class GoogleMapsClientServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslations();
        $this->publishAssets();
    }

    private function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/Resources/lang', 'googlemapsclient');
    }

    private function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/../config/googlemapsclient.php' => config_path('googlemapsclient.php'),
        ], 'config');
    }
}
