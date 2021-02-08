<?php

namespace App\Console\Commands\Import;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ImportAllCommand extends BaseCommand
{

    protected $signature = 'import:all';

    protected $description = 'Run all import commands';

    public function handle()
    {
        // TODO: This causes issues with writing to the `commands` table!
        // $this->call('db:reset'); // Add --yes flag?
        // $this->call('migrate');
        $this->call('import:collections-full');
        $this->call('import:assets-full');
        $this->call('import:events-ticketed-full', ['--yes' => 'default']);
        $this->call('import:dsc', ['--yes' => 'default', '-v' => 'default']);
        $this->call('import:mobile');
        $this->call('import:library', ['--yes' => 'default']);
        $this->call('import:archive', ['--yes' => 'default']);
        $this->call('import:sites', ['--yes' => 'default']);
        $this->call('import:ulan');
        $this->call('import:products-full', ['--yes' => 'default']);
        $this->call('import:analytics');
        $this->call('import:web-full', ['--yes' => 'default']);
    }
}
