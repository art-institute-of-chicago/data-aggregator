<?php

namespace App\Console;

use Illuminate\Support\Facades\App;

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
        \Aic\Hub\Foundation\Commands\DatabaseReset::class,
        \Aic\Hub\Foundation\Commands\MakeUser::class,
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
            ->sendOutputTo(storage_path('logs/import-daily-last-run.log'));

        $schedule->command('scout:import-all')
            ->dailyAt('03:00')
            ->sendOutputTo(storage_path('logs/scout-import-all-last-run.log'));

        $schedule->command('search:audit')
            ->dailyAt('05:00')
            ->sendOutputTo(storage_path('logs/search-audit-last-run.log'));

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

        // $schedule->command('dump:nightly')
        //     ->dailyAt('22:45')
        //     ->withoutOverlapping(self::FOR_ONE_YEAR)
        //     ->sendOutputTo(storage_path('logs/data-dump-last-run.log'));
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
