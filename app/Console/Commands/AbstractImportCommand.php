<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

abstract class AbstractImportCommand extends Command
{

    /**
     * A Faker Generator for filler data.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->faker = \Faker\Factory::create();

        parent::__construct();

    }

    /**
     * Convenience curl wrapper. Accepts `GET` URL. Returns decoded JSON.
     *
     * @param string $url
     *
     * @return string
     */
    protected function query($url)
    {

        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);
        $string = ob_get_contents();

        ob_end_clean();

        return json_decode($string);

    }

}
