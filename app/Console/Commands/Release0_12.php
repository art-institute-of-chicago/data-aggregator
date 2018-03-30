<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class Release0_12 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'release:0.12';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run commands required for release 0.12';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Term Types
        $this->call('import:collections-full', ['endpoint' => 'term-types']);

        // Terms
        $this->call('import:collections-full', ['endpoint' => 'terms']);
        DB::delete('delete from terms where lake_guid is null');

        // Artwork Terms
        DB::delete('delete from artwork_terms');
        $this->call('import:collections-full', ['endpoint' => 'artworks']);

    }
}
