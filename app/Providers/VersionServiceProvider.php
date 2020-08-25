<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VersionServiceProvider extends ServiceProvider
{

    /**
     * Register any application service.
     */
    public function register()
    {
        config(['aic.version' => trim(file_get_contents(__DIR__ . '/../../VERSION'))]);
    }

}
