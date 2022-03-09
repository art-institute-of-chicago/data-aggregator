<?php

namespace App\Console\Commands\Import;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ImportScheduleMonthly extends BaseCommand
{

    protected $signature = 'import:monthly';

    protected $description = 'Do a full refresh on some hefty, infrequently updated sources.';

    public function handle()
    {
        $this->call('import:analytics');

        $this->call('import:library', ['--yes' => 'default']);
        $this->call('import:archive', ['--yes' => 'default']);
        $this->call('import:sites', ['--yes' => 'default']);
        $this->call('import:dsc', ['--yes' => 'default']);
    }
}
