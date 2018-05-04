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

        $this->importFromWeb(Article::class, 'articles');
        $this->importFromWeb(Artist::class, 'artists');
        $this->importFromWeb(Closure::class, 'closures');
        $this->importFromWeb(Event::class, 'events');
        $this->importFromWeb(Exhibition::class, 'exhibitions');
        $this->importFromWeb(Hour::class, 'hours');
        $this->importFromWeb(Location::class, 'locations');
        $this->importFromWeb(Selection::class, 'selections');
        $this->importFromWeb(Tag::class, 'tags');

        $this->importFromWeb(GenericPage::class, 'genericpages');
        $this->importFromWeb(PressRelease::class, 'pressreleases');
        $this->importFromWeb(ResearchGuide::class, 'researchguides');
        $this->importFromWeb(EducatorResource::class, 'educatorresources');
        $this->importFromWeb(DigitalCatalog::class, 'digitalcatalogs');
        $this->importFromWeb(PrintedCatalog::class, 'printedcatalogs');

    }

    protected function importFromWeb($model, $endpoint)
    {

        return $this->import( 'Web', $model, $endpoint );

    }

    protected function query( $endpoint, $page = 1, $limit = 100 )
    {

        if (env('WEB_CMS_DATA_SERVICE_USERNAME'))
        {
            $this->auth = env('WEB_CMS_DATA_SERVICE_USERNAME') . ':' . env('WEB_CMS_DATA_SERVICE_PASSWORD');
        }

        return parent::query( $endpoint, $page, $limit );
    }

    protected function save( $datum, $model, $transformer )
    {

        // TODO: Remove this work-around after Articles have been sanitized
        // if( $model === Article::class && $datum->id === 538 )
        // {
        //     $this->warn("Error on #{$datum->id}: " . $this->api . '/articles/' . $datum->id);
        //     return;
        // }

        try {

            parent::save( $datum, $model, $transformer );

        } catch( \Exception $e ) {

            $this->warn("Error on #{$datum->id}: " . $model);
            $this->info($e->getMessage());

        }

    }

}
