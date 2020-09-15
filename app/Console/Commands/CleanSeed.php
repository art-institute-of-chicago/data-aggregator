<?php

namespace App\Console\Commands;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class CleanSeed extends BaseCommand
{

    protected $signature = 'db:cleanseed';

    protected $description = 'Delete the seeded records from the database';

    public function handle()
    {
        \DatabaseSeeder::clean();
    }
}
