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

        $schedule->command('import:daily --quiet')
            ->dailyAt('23:00')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-daily.log'))
            ->sendOutputTo(storage_path('logs/import-daily-last-run.log'))
            ->emailOutputTo([env('LOG_EMAIL_1'), env('LOG_EMAIL_2')], true);

        $schedule->command('import:monthly --quiet')
            ->monthlyOn(1, '03:00')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-monthly.log'))
            ->sendOutputTo(storage_path('logs/import-monthly-last-run.log'))
            ->emailOutputTo([env('LOG_EMAIL_1'), env('LOG_EMAIL_2')], true);

        // Non-prod envs don't need 5-min imports
        if (!App::environment('production'))
        {
            return;
        }

        $schedule->command('import:collections --quiet')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-collections.log'))
            ->sendOutputTo(storage_path('logs/import-collections-last-run.log'))
            ->emailOutputTo([env('LOG_EMAIL_1'), env('LOG_EMAIL_2')], true);

        $schedule->command('import:web --quiet')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-web.log'))
            ->sendOutputTo(storage_path('logs/import-web-last-run.log'))
            ->emailOutputTo([env('LOG_EMAIL_1'), env('LOG_EMAIL_2')], true);

        $schedule->command('import:collections-delete --quiet')
            ->hourly()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/import-collections-delete.log'))
            ->sendOutputTo(storage_path('logs/import-collections-delete-last-run.log'))
            ->emailOutputTo([env('LOG_EMAIL_1'), env('LOG_EMAIL_2')], true);

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

    }
}
