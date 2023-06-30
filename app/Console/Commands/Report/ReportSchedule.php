<?php

namespace App\Console\Commands\Report;

use Illuminate\Console\Scheduling\Schedule;
use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportSchedule extends BaseCommand
{
    protected $signature = 'report:schedule';

    protected $description = 'Show which scheduled tasks are currently running';

    public function handle()
    {
        $events = app(Schedule::class)->events();

        foreach ($events as $event) {
            $command = implode(' ', array_slice(explode(' ', $event->command), 2));
            $this->info($command . ' = ' . var_export($event->mutex->exists($event), true));
        }
    }
}
