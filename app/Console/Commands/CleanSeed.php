<?php

namespace App\Console\Commands;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class CleanSeed extends BaseCommand
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
