<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the Faker application service.
     *
     * Peruse the following link for tips on implementing custom Faker providers:
     * @link https://stackoverflow.com/questions/38250776/how-to-implement-your-own-faker-provider-in-laravel
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('Faker', function($app) {

            return \Faker\Factory::create();

        });


        // This forces factories to use our enhanced Faker by default
        $this->app->singleton('Faker\Generator', function($app) {

            return app('Faker');

        });

    }
}
