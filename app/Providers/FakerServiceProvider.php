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

        $this->app->singleton('Faker', function ($app) {

            $faker = \Faker\Factory::create();

            // This illustrates how to add custom Faker providers
            $newProvider = new class($faker) extends \Faker\Provider\Base {

                // Used in Collections\Artwork and Dsc\Section
                public function accession()
                {
                    return strval( $this->generator->randomFloat(3, 1900, 2018) );
                }

            };

            $faker->addProvider($newProvider);

            return $faker;

        });

        // This forces factories to use our enhanced Faker by default
        $this->app->singleton('Faker\Generator', function ($app) {

            return app('Faker');

        });

    }
}
