<?php

namespace App\Console;

use Illuminate\Support\Facades\App;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * Use this to import third-party Artisan commands.
     *
     * @var array
     */
    protected $commands = [
        \Aic\Hub\Foundation\Commands\DatabaseReset::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('import:daily')
            ->dailyAt('23:00')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-daily.log'))
            ->sendOutputTo(storage_path('logs/import-daily-last-run.log'));

        $schedule->command('scout:import-all')
            ->dailyAt('03:00')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/scout-import-all.log'))
            ->sendOutputTo(storage_path('logs/scout-import-all-last-run.log'));

        $schedule->command('import:monthly')
            ->monthlyOn(1, '03:00')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-monthly.log'))
            ->sendOutputTo(storage_path('logs/import-monthly-last-run.log'));

        // Because in the CMS Events don't get touched when a ticketed event
        // is added. Remove this once that's in place.
        $schedule->command('import:web-full events --yes')
            ->hourly()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-web-full.log'))
            ->sendOutputTo(storage_path('logs/import-web-full-last-run.log'));

        $schedule->command('import:web')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-web.log'))
            ->sendOutputTo(storage_path('logs/import-web-last-run.log'));

        // Non-prod envs don't need 5-min imports on collections
        if (!App::environment('production'))
        {
            return;
        }

        $schedule->command('import:collections')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-collections.log'))
            ->sendOutputTo(storage_path('logs/import-collections-last-run.log'));

        $schedule->command('import:collections-delete')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-collections-delete.log'))
            ->sendOutputTo(storage_path('logs/import-collections-delete-last-run.log'));

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {

        // TODO: Consider adding recursive load here?
        $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/Update');
        $this->load(__DIR__.'/Report');

    }
}
