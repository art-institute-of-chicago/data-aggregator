<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * WEB-874: Make commands never overlap.
     */
    private const FOR_ONE_YEAR = 525600;

    /**
     * Use this to import third-party Artisan commands.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:cloudfront-ips')
            ->hourly();

        $schedule->command('import:daily')
            ->dailyAt('23:00')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-daily-last-run.log'));

        $schedule->command('import:monthly')
            ->monthlyOn(1, '03:00')
            ->sendOutputTo(storage_path('logs/import-monthly-last-run.log'));

        $schedule->command('import:web')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-last-run.log'));

        $schedule->command('import:events-ticketed-full --unreset')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-events-ticketed-last-run.log'));

        $schedule->command('delete:assets')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/delete-assets-last-run.log'));

        $schedule->command('delete:collections')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/delete-collections-last-run.log'));

        $schedule->command('import:assets')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-assets-last-run.log'));

        $schedule->command('import:collections')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-collections-last-run.log'));

        $schedule->command('import:queues')
            ->everyMinute()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-queues-last-run.log'));

        $schedule->command('import:enhancer')
            ->everyMinute()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-enhancer-last-run.log'));

        // API-231, API-232: Temporary remediation! Artworks can't touch artists.
        $schedule->command('scout:import', [
            \App\Models\Collections\Agent::class,
        ])
            ->hourly()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/scout-import-agents-last-run.log'));

        if (env('DUMP_SCHEDULE_ENABLED', false)) {
            $schedule->command('dump:schedule')
                ->weekly()
                ->sundays()
                ->withoutOverlapping(self::FOR_ONE_YEAR)
                ->sendOutputTo(storage_path('logs/data-dump-last-run.log'));
        }
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        $this->load(__DIR__ . '/Commands/Docs');
        $this->load(__DIR__ . '/Commands/Import');
        $this->load(__DIR__ . '/Commands/Prototype');
        $this->load(__DIR__ . '/Commands/Report');
        $this->load(__DIR__ . '/Commands/Search');
        $this->load(__DIR__ . '/Commands/Update');
    }
}
