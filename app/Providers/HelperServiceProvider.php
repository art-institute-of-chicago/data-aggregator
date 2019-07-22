<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helpers/Util.php');
        require_once app_path('Helpers/ColorHelpers.php');
    }
}
