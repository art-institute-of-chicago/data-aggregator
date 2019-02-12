<?php

namespace App\Console\Commands\Import;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ImportAllCommand extends BaseCommand
{

    protected $signature = 'import:all';

    protected $description = 'Run all import commands';


    public function handle()
    {

        $this->call('db:reset'); // Add --yes flag?
        $this->call('migrate');
        $this->call('import:collections-full');
        $this->call('import:events-ticketed-full', ['--yes' => 'default']);
        $this->call('import:dsc', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:mobile');
        $this->call('import:library', ['--yes' => 'default']);
        $this->call('import:archive', ['--yes' => 'default']);
        $this->call('import:sites', ['--yes' => 'default']);
        $this->call('import:set-ulan-uris');
        $this->call('import:products-full', ['--yes' => 'default']);
        $this->call('import:images');
        $this->call('import:analytics');

    }

}
