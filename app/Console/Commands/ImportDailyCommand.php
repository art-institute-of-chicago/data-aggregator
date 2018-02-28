<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportDailyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:daily';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all increment commands on sources that we\'re able to, and do a full refresh on sources that require it.';

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

        $this->call('import:collections');
        $this->call('import:exhibitions-legacy');
        $this->call('import:events-ticketed');
        $this->call('import:events-legacy');
        $this->call('import:dsc', ['--yes' => 'default']);
        $this->call('import:mobile');
        $this->call('import:library', ['--yes' => 'default']);
        $this->call('import:archive', ['--yes' => 'default']);
        $this->call('import:sites', ['--yes' => 'default']);
        $this->call('import:set-ulan-uris');
        $this->call('import:products');

    }

}
