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

        $this->call('import:collections', ['-v' => 'default']);
        $this->call('import:exhibitions-legacy', ['-v' => 'default']);
        $this->call('import:events-ticketed', ['-v' => 'default']);
        $this->call('import:events-legacy', ['-v' => 'default']);
        $this->call('import:dsc', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:mobile', ['-v' => 'default']);
        $this->call('import:library', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:archive', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:sites', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:set-ulan-uris', ['-v' => 'default']);

    }

}
