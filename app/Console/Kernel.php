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
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-mobile-last-run.log'));

        //
        // Shop
        $schedule->command('import:products-full', ['--yes'])
            ->dailyAt('23:10')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-products-full-last-run.log'));

        //
        // Website
        $schedule->command('import:web-full', ['articles', '--yes'])
            ->dailyAt('23:15')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-articles-last-run.log'));

        $schedule->command('import:web-full', ['artworks', '--yes'])
            ->dailyAt('23:18')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-artworks-last-run.log'));

        $schedule->command('import:web-full', ['artists', '--yes'])
            ->dailyAt('23:21')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-artists-last-run.log'));

        $schedule->command('import:web-full', ['events', '--yes'])
            ->dailyAt('23:24')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-events-last-run.log'));

        $schedule->command('import:web-full', ['event-occurrences', '--yes'])
            ->dailyAt('23:27')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-event-occurrences-last-run.log'));

        $schedule->command('import:web-full', ['event-programs', '--yes'])
            ->dailyAt('23:30')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-event-programs-last-run.log'));

        $schedule->command('import:web-full', ['exhibitions', '--yes'])
            ->dailyAt('23:33')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-exhibitions-last-run.log'));

        $schedule->command('import:web-full', ['highlights', '--yes'])
            ->dailyAt('23:36')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-highlights-last-run.log'));

        $schedule->command('import:web-full', ['genericpages', '--yes'])
            ->dailyAt('23:39')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-genericpages-last-run.log'));

        $schedule->command('import:web-full', ['pressreleases', '--yes'])
            ->dailyAt('23:42')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-pressreleases-last-run.log'));

        $schedule->command('import:web-full', ['educatorresources', '--yes'])
            ->dailyAt('23:45')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-educatorresources-last-run.log'));

        $schedule->command('import:web-full', ['digitalpublications', '--yes'])
            ->dailyAt('23:48')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-digitalpublications-last-run.log'));

        $schedule->command('import:web-full', ['digitalpublicationsections', '--yes'])
            ->dailyAt('23:51')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-digitalpublicationsections-last-run.log'));

        $schedule->command('import:web-full', ['printedpublications', '--yes'])
            ->dailyAt('23:54')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-printedpublications-last-run.log'));

        $schedule->command('import:web-full', ['staticpages', '--yes'])
            ->dailyAt('23:57')
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-full-staticpages-last-run.log'));

        $schedule->command('import:web')
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-web-last-run.log'));

        //
        // Archived Static sites
        $schedule->command('import:sites', ['--yes'])
            ->monthlyOn(1, '03:00')
            ->sendOutputTo(storage_path('logs/import-sites-last-run.log'));

        //
        // Digital scholarly catalogues
        $schedule->command('import:dsc', ['--yes'])
            ->monthlyOn(1, '03:05')
            ->sendOutputTo(storage_path('logs/import-dsc-last-run.log'));

        //
        // Google Analytics
        $schedule->command('import:analytics')
            ->monthlyOn(1, '03:10')
            ->sendOutputTo(storage_path('logs/import-analytics-last-run.log'));

        //
        // Ticketed events
        $schedule->command('import:events-ticketed-full', ['--unreset'])
            ->everyFiveMinutes()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-events-ticketed-last-run.log'));

        //
        // Collections and DAMS
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

        //
        // Virtual lines
        $schedule->command('import:queues')
            ->everyMinute()
            ->withoutOverlapping(self::FOR_ONE_YEAR)
            ->sendOutputTo(storage_path('logs/import-queues-last-run.log'));

        //
        // Data enhancer
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

        if (config('aic.dump.schedule_enabled')) {
            $schedule->command('dump:schedule')
                ->weekly()
                ->sundays()
                ->withoutOverlapping(self::FOR_ONE_YEAR)
                ->sendOutputTo(storage_path('logs/data-dump-last-run.log'));
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
