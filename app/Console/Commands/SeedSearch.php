<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedSearch extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:search
                            {seeder : Seeder classname }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-seed and re-index a specific model';

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

        // @TODO Use removeAllFromSearch() or unsearchable()
        // @TODO Implement delete in SolrScoutEngine

        // For now, issue delete all query to the Solr index
        file_get_contents(
            'http://' . env('SOLR_HOST') . ':' . env('SOLR_PORT') . env('SOLR_PATH') . env('SOLR_CORE')
            . '/update?stream.body='
            . urlencode('<delete><query>*:*</query></delete>')
            . '&commit=true'
        );

        $this->info( 'Cleared Solr index...' );

        $class = $this->argument('seeder');
        $seeder = new $class();

        $seeder->run();

        $this->info( 'Seeded: ' . $class );


    }

}
