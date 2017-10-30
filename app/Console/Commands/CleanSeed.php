<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanSeed extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:cleanseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the seeded records from the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        \DatabaseSeeder::clean();

    }

}
