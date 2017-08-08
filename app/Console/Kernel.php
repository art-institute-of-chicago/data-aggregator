<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ImportCollectionsFull::class,
        Commands\ImportCollections::class,
        Commands\ScoutImportOne::class,
        Commands\ScoutImportAll::class,
        Commands\ScoutFlushAll::class,
        Commands\ScoutRefresh::class,
        Commands\ScoutRefreshAll::class,
        Commands\InstallSearch::class,
        Commands\UninstallSearch::class,
        Commands\ReindexSearch::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('import:collections')
            ->everyFiveMinutes()
            ->withoutOverlapping();;
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
