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

        $this->call('db:reset'); // Add --yes flag?
        $this->call('migrate', ['-v' => 'default']);
        $this->call('import:collections-full', ['-v' => 'default']);
        $this->call('import:exhibitions-legacy', ['-v' => 'default']);
        $this->call('import:events-ticketed-full', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:events-legacy', ['-v' => 'default']);
        $this->call('import:dsc', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:mobile', ['-v' => 'default']);
        $this->call('import:library', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:archive', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:sites', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:set-ulan-uris', ['-v' => 'default']);
        $this->call('import:terms-legacy', ['-v' => 'default']);

    }

}
