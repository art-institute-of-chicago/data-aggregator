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
                            {endpoint? : Endpoint on dataservice to query, e.g. `events`}
                            {--y|yes : Answer "yes" to all prompts}
                            {page? : Page to begin importing from}';

    protected $description = "Import all Web CMS data";


    public function handle()
    {

        $this->api = env('WEB_CMS_DATA_SERVICE_URL');

        $endpoint = $this->argument('endpoint');

        if ($endpoint) {

            $page = $this->argument('page') ?: 1;

            $this->importFromWeb($endpoint, $page);
            $this->info("Imported ${endpoint} web CMS content!");

        } else {

            if( !$this->reset() )
            {
                return false;
            }
            $this->importEndpoints();
            $this->info("Imported all web CMS content!");

        }

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

        $this->importFromWeb('articles');
        // Incorrect integer value: 'Also known as' for column 'also_known_as'
        // $this->importFromWeb('artists');
        $this->importFromWeb('closures');
        $this->importFromWeb('events');
        $this->importFromWeb('exhibitions');
        $this->importFromWeb('hours');
        $this->importFromWeb('locations');
        $this->importFromWeb('selections');
        $this->importFromWeb('tags');

        $this->importFromWeb('genericpages');
        $this->importFromWeb('pressreleases');
        $this->importFromWeb('researchguides');
        $this->importFromWeb('educatorresources');
        $this->importFromWeb('digitalcatalogs');
        $this->importFromWeb('printedcatalogs');

    }

    protected function getModelForEndpoint($endpoint)
    {

        switch( $endpoint )
        {
            case 'articles':
                return Article::class;
            break;
            case 'artists':
                return Artist::class;
            break;
            case 'closures':
                return Closure::class;
            break;
            case 'events':
                return Event::class;
            break;
            case 'exhibitions':
                return Exhibition::class;
            break;
            case 'hours':
                return Hour::class;
            break;
            case 'locations':
                return Location::class;
            break;
            case 'selections':
                return Selection::class;
            break;
            case 'tags':
                return Tag::class;
            break;
            case 'genericpages':
                return GenericPage::class;
            break;
            case 'pressreleases':
                return PressRelease::class;
            break;
            case 'researchguides':
                return ResearchGuide::class;
            break;
            case 'educatorresources':
                return EducatorResource::class;
            break;
            case 'digitalcatalogs':
                return DigitalCatalog::class;
            break;
            case 'printedcatalogs':
                return PrintedCatalog::class;
            break;
            default:
                // TODO: This gets endpoints as outbound from our API
                // Endpoints in the dataservice might be different!
                return app('Resources')->getModelForEndpoint($endpoint);
            break;
        }

    }

    protected function importFromWeb($endpoint, $page = 1)
    {

        $model = $this->getModelForEndpoint($endpoint);
        return $this->import( 'Web', $model, $endpoint, $page );

    }

    protected function query( $endpoint, $page = 1, $limit = 100 )
    {

        if (env('WEB_CMS_DATA_SERVICE_USERNAME'))
        {
            $this->auth = env('WEB_CMS_DATA_SERVICE_USERNAME') . ':' . env('WEB_CMS_DATA_SERVICE_PASSWORD');
        }

        return parent::query( $endpoint, $page, $limit );
    }

}
