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

}
