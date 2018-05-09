<?php

namespace App\Console\Commands;

use App\Models\Web\Article;
use App\Models\Web\Artist;
use App\Models\Web\Closure;
use App\Models\Web\Event;
use App\Models\Web\Exhibition;
use App\Models\Web\Hour;
use App\Models\Web\Location;
use App\Models\Web\Page;
use App\Models\Web\Selection;
use App\Models\Web\Tag;
use App\Models\Web\GenericPage;
use App\Models\Web\PressRelease;
use App\Models\Web\ResearchGuide;
use App\Models\Web\EducatorResource;
use App\Models\Web\DigitalCatalog;
use App\Models\Web\PrintedCatalog;

class ImportWebFull extends AbstractImportCommand
{

    protected $signature = 'import:web-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all Web CMS data";


    public function handle()
    {

        $this->api = env('WEB_CMS_DATA_SERVICE_URL');

        if( !$this->reset() )
        {
            return false;
        }

        $this->importEndpoints();

        $this->info("Imported all web CMS content!");

    }

    protected function reset()
    {

        return $this->resetData(
            [
                Article::class,
                Artist::class,
                Closure::class,
                Event::class,
                Exhibition::class,
                Hour::class,
                Location::class,
                Selection::class,
                Tag::class,
                GenericPage::class,
                PressRelease::class,
                ResearchGuide::class,
                EducatorResource::class,
                DigitalCatalog::class,
                PrintedCatalog::class,
            ],
            [
                'articles',
                'web_artists',
                'closures',
                'events',
                'web_exhibitions',
                'hours',
                'locations',
                'selections',
                'tags',
                'generic_pages',
                'press_releases',
                'research_guides',
                'educator_resources',
                'digital_catalogs',
                'printed_catalogs',
            ]
        );

    }

    protected function importEndpoints()
    {

        $this->import(Article::class, 'articles');
        $this->import(Artist::class, 'artists');
        $this->import(Closure::class, 'closures');
        $this->import(Event::class, 'events');
        $this->import(Exhibition::class, 'exhibitions');
        $this->import(Hour::class, 'hours');
        $this->import(Location::class, 'locations');
        $this->import(Selection::class, 'selections');
        $this->import(Tag::class, 'tags');
        $this->import(GenericPage::class, 'genericpages');
        $this->import(PressRelease::class, 'pressreleases');
        $this->import(ResearchGuide::class, 'researchguides');
        $this->import(EducatorResource::class, 'educatorresources');
        $this->import(DigitalCatalog::class, 'digitalcatalogs');
        $this->import(PrintedCatalog::class, 'printedcatalogs');

    }

    protected function query( $endpoint, $page = 1, $limit = 100 )
    {

        if (env('WEB_CMS_DATA_SERVICE_USERNAME'))
        {
            $this->auth = env('WEB_CMS_DATA_SERVICE_USERNAME') . ':' . env('WEB_CMS_DATA_SERVICE_PASSWORD');
        }

        return parent::query( $endpoint, $page, $limit );
    }

    protected function save( $datum, $model )
    {

        // TODO: Remove this work-around after Articles have been sanitized
        // if( $model === Article::class && $datum->id === 538 )
        // {
        //     $this->warn("Error on #{$datum->id}: " . $this->api . '/articles/' . $datum->id);
        //     return;
        // }

        try {

            parent::save( $datum, $model );

        } catch( \Exception $e ) {

            $this->warn("Error on #{$datum->id}: " . $model);
            $this->info($e->getMessage());

        }

    }

}
