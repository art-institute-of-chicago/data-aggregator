<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:all';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all import commands';

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

        //$this->call('db:reset');
        //$this->call('migrate');
        //$this->call('import:collections-full');
        //$this->call('import:exhibitions-legacy');
        //$this->call('import:events-full');
        //$this->call('import:events-legacy');
        //$this->call('import:dsc');
        //$this->call('import:mobile');
        //$this->call('import:library');
        //$this->call('import:archive');
        //$this->call('import:sites');
        $this->call('import:set-ulan-uris');

    }

}
