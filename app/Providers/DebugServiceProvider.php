<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DebugServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('debug', function ($app) {

            return new class() {

                private $output = [];

                public function log($transformer, $field, $time)
                {
                    if (!isset($this->output[$transformer])) {
                        $this->output[$transformer] = [];
                    }

                    if (!isset($this->output[$transformer][$field])) {
                        $this->output[$transformer][$field] = $time;
                    } else {
                        $this->output[$transformer][$field] += $time;
                    }

                    return $this->output[$transformer][$field];
                }

                public function getOutput()
                {
                    return $this->output;
                }

            };
        });
    }
}
