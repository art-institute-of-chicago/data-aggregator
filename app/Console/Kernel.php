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

        Commands\ImagesColor::class,
        Commands\ImagesExport::class,
        Commands\ImagesImport::class,
        Commands\ImagesDownload::class,

        Commands\ImportCollectionsFull::class,
        Commands\ImportCollections::class,
        Commands\ImportEssentials::class,
        Commands\ImportEventsFull::class,
        Commands\ImportEvents::class,
        Commands\ImportMobile::class,
        Commands\ImportCatalogues::class,
        Commands\ImportLegacyEvents::class,
        Commands\ImportSites::class,
        Commands\ImportSetArtists::class,

        Commands\ScoutImportOne::class,
        Commands\ScoutImportAll::class,
        Commands\ScoutFlushAll::class,
        Commands\ScoutRefresh::class,
        Commands\ScoutRefreshAll::class,

        Commands\SearchAlias::class,
        Commands\SearchInstall::class,
        Commands\SearchReindex::class,
        Commands\SearchUninstall::class,

        Commands\CreateEndpointDocs::class,
        Commands\CreateFieldsDocs::class,
        Commands\CleanSeed::class,

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
        //
    }
}
