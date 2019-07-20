<?php

namespace App\Console\Commands\Import;

use App\Models\Web\Article;
use App\Models\Web\Artist;
use App\Models\Web\Closure;
use App\Models\Web\Event;
use App\Models\Web\EventOccurrence;
use App\Models\Web\EventProgram;
use App\Models\Web\Exhibition;
use App\Models\Web\Hour;
use App\Models\Web\Location;
use App\Models\Web\Selection;
use App\Models\Web\Tag;
use App\Models\Web\GenericPage;
use App\Models\Web\PressRelease;
use App\Models\Web\ResearchGuide;
use App\Models\Web\EducatorResource;
use App\Models\Web\DigitalCatalog;
use App\Models\Web\PrintedCatalog;
use App\Models\Web\StaticPage;
use App\Models\Web\EmailSeries;
use App\Models\Web\Sponsor;

class ImportWebFull extends AbstractImportCommand
{

    protected $signature = 'import:web-full
                            {endpoint? : Endpoint on dataservice to query, e.g. `events`}
                            {page? : Page to begin importing from}
                            {--y|yes : Answer "yes" to all prompts}
                            {--test : Only import one page from each endpoint}';

    protected $description = 'Import all Web CMS data';

    public function handle()
    {

        if ($this->option('test')) {
            $this->isTest = true;
        }

        $this->api = env('WEB_CMS_DATA_SERVICE_URL');

        $endpoint = $this->argument('endpoint');

        if(!$this->reset($endpoint))
        {
            return false;
        }

        if ($endpoint) {

            $page = $this->argument('page') ?: 1;

            $this->importFromWeb($endpoint, $page);
            $this->info("Imported ${endpoint} web CMS content!");

        } else {

            $this->importEndpoints();
            $this->info('Imported all web CMS content!');

        }

    }

    protected function reset($endpoint = null)
    {

        $hash = [
            Article::class => 'articles',
            Artist::class => 'web_artists',
            Closure::class => 'closures',
            Event::class => 'events',
            EventOccurrence::class => 'event_occurrences',
            EventProgram::class => 'event_programs',
            Exhibition::class => 'web_exhibitions',
            Hour::class => 'hours',
            Location::class => 'locations',
            Selection::class => 'selections',
            Tag::class => 'tags',
            GenericPage::class => 'generic_pages',
            PressRelease::class => 'press_releases',
            ResearchGuide::class => 'research_guides',
            EducatorResource::class => 'educator_resources',
            DigitalCatalog::class => 'digital_catalogs',
            PrintedCatalog::class => 'printed_catalogs',
            StaticPage::class => 'static_pages',
            EmailSeries::class => 'email_series',
            Sponsor::class => 'sponsors',
        ];

        if ($endpoint) {
            $model = $this->getModelForEndpoint($endpoint);

            return $this->resetData([$model], [$hash[$model]]);
        }

        return $this->resetData(array_keys($hash), array_values($hash));

    }

    protected function importEndpoints()
    {

        $this->importFromWeb('articles');
        $this->importFromWeb('artists');
        $this->importFromWeb('closures');
        $this->importFromWeb('events');
        // we do not import events/occurrences here to avoid import:web cascade
        // $this->importFromWeb('event-occurrences');
        $this->importFromWeb('event-programs');
        $this->importFromWeb('exhibitions');
        $this->importFromWeb('hours');
        $this->importFromWeb('locations');
        $this->importFromWeb('selections');
        $this->importFromWeb('tags');

        $this->importFromWeb('genericpages');
        $this->importFromWeb('pressreleases');
        $this->importFromWeb('researchguides');
        $this->importFromWeb('educatorresources');
        $this->importFromWeb('digitalpublications');
        $this->importFromWeb('printedpublications');

        $this->importFromWeb('staticpages');
        $this->importFromWeb('emailseries');
        $this->importFromWeb('sponsors');

    }

    protected function getModelForEndpoint($endpoint)
    {
        return app('Resources')->getModelForInboundEndpoint($endpoint, 'web');
    }

    protected function importFromWeb($endpoint, $page = 1)
    {

        $model = $this->getModelForEndpoint($endpoint);
        return $this->import('Web', $model, $endpoint, $page);

    }

    protected function query($endpoint, $page = 1, $limit = 100)
    {

        if (env('WEB_CMS_DATA_SERVICE_USERNAME'))
        {
            $this->auth = env('WEB_CMS_DATA_SERVICE_USERNAME') . ':' . env('WEB_CMS_DATA_SERVICE_PASSWORD');
        }

        return parent::query($endpoint, $page, $limit);
    }

}
