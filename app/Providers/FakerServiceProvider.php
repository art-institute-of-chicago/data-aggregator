<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
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

        $this->app->afterResolving(function (mixed $instance) {
            if ($instance instanceof \Faker\Generator) {
                $instance->addProvider(new class ()  {
                    // Used in Collections\Artwork and Dsc\Section
                    public function accession()
                    {
                        return (string) (fake()->randomFloat(3, 1900, 2018));
                    }
                });
            }
        });
    }
}
