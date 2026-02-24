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
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('cache:prune-stale-tags')
            ->hourly();

        $schedule->command('update:cloudfront-ips')
            ->hourly();

        //
        // Mobile app
        $schedule->command('import:mobile')
            ->dailyAt('23:05')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        //
        // Shop
        $schedule->command('import:products-full', ['--yes'])
            ->dailyAt('23:10')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        //
        // Website
        $schedule->command('import:web-full', ['articles', '--yes'])
            ->dailyAt('23:15')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['artworks', '--yes'])
            ->dailyAt('23:18')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['artists', '--yes'])
            ->dailyAt('23:21')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['events', '--yes'])
            ->dailyAt('23:24')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['event-occurrences', '--yes'])
            ->dailyAt('23:27')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['event-programs', '--yes'])
            ->dailyAt('23:30')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['exhibitions', '--yes'])
            ->dailyAt('23:33')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['highlights', '--yes'])
            ->dailyAt('23:36')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['genericpages', '--yes'])
            ->dailyAt('23:39')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['pressreleases', '--yes'])
            ->dailyAt('23:42')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['educatorresources', '--yes'])
            ->dailyAt('23:45')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['digitalpublications', '--yes'])
            ->dailyAt('23:48')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['digitalpublicationarticles', '--yes'])
            ->dailyAt('23:51')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['printedpublications', '--yes'])
            ->dailyAt('23:54')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['staticpages', '--yes'])
            ->dailyAt('23:57')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web-full', ['hours', '--yes'])
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:web')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('ai:embed-description')
            ->everyMinute()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        //
        // Archived Static sites
        $schedule->command('import:sites', ['--yes'])
            ->monthlyOn(1, '03:00');

        //
        // Digital scholarly catalogues
        $schedule->command('import:dsc', ['--yes'])
            ->monthlyOn(1, '03:05');

        //
        // Google Analytics
        $schedule->command('import:analytics')
            ->monthlyOn(1, '03:10');

        //
        // Ticketed events
        $schedule->command('import:events-ticketed-full', ['--unreset'])
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        //
        // Collections and DAMS
        $schedule->command('delete:assets')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('delete:collections')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:assets')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        $schedule->command('import:collections')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        //
        // Virtual lines
        $schedule->command('import:queues')
            ->everyMinute()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        //
        // Data enhancer
        $schedule->command('import:enhancer')
            ->everyMinute()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        // API-231, API-232: Temporary remediation! Artworks can't touch artists.
        $schedule->command('scout:import', [
            \App\Models\Collections\Agent::class,
        ])
            ->hourly()
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        // API-401: Make sure the artworks index is always in sync with the datebase
        $schedule->command('scout:import', [
            \App\Models\Collections\Artwork::class,
        ])
            ->dailyAt('22:10')
            ->withoutOverlapping(self::FOR_ONE_YEAR);

        if (config('aic.dump.schedule_enabled')) {
            $schedule->command('dump:schedule')
                ->weekly()
                ->sundays()
                ->withoutOverlapping(self::FOR_ONE_YEAR);
        }
    }

    /**
     * Register the Closure based commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        $this->load(__DIR__ . '/Commands/Docs');
        $this->load(__DIR__ . '/Commands/Import');
        $this->load(__DIR__ . '/Commands/Migrations');
        $this->load(__DIR__ . '/Commands/Report');
        $this->load(__DIR__ . '/Commands/Search');
        $this->load(__DIR__ . '/Commands/Update');
    }
}
