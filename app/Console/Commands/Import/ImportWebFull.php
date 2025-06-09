<?php

namespace App\Console\Commands\Import;

use App\Models\Web\Article;
use App\Models\Web\Artist;
use App\Models\Web\Artwork;
use App\Models\Web\Event;
use App\Models\Web\EventOccurrence;
use App\Models\Web\EventProgram;
use App\Models\Web\Exhibition;
use App\Models\Web\Highlight;
use App\Models\Web\Hour;
use App\Models\Web\GenericPage;
use App\Models\Web\LandingPage;
use App\Models\Web\PressRelease;
use App\Models\Web\EducatorResource;
use App\Models\Web\DigitalPublication;
use App\Models\Web\DigitalPublicationArticle;
use App\Models\Web\PrintedPublication;
use App\Models\Web\StaticPage;

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

        $this->api = config('resources.sources.web');

        $endpoint = $this->argument('endpoint');

        if (!$this->reset($endpoint)) {
            return false;
        }

        if ($endpoint) {
            $page = $this->argument('page') ?: 1;

            $this->importFromWeb($endpoint, $page);
            $this->info("Imported {$endpoint} web CMS content!");
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
            Artwork::class => 'web_artworks',
            Event::class => 'events',
            EventOccurrence::class => 'event_occurrences',
            EventProgram::class => 'event_programs',
            Exhibition::class => 'web_exhibitions',
            Highlight::class => 'highlights',
            GenericPage::class => 'generic_pages',
            LandingPage::class => 'landing_pages',
            PressRelease::class => 'press_releases',
            EducatorResource::class => 'educator_resources',
            DigitalPublication::class => 'digital_publications',
            DigitalPublicationArticle::class => 'digital_publication_articles',
            PrintedPublication::class => 'printed_publications',
            StaticPage::class => 'static_pages',
            Hour::class => 'hours',
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
        $this->importFromWeb('artworks');
        $this->importFromWeb('events');
        $this->importFromWeb('event-occurrences');
        $this->importFromWeb('event-programs');
        $this->importFromWeb('exhibitions');
        $this->importFromWeb('highlights');

        $this->importFromWeb('genericpages');
        $this->importFromWeb('landingpages');
        $this->importFromWeb('pressreleases');
        $this->importFromWeb('educatorresources');
        $this->importFromWeb('digitalpublications');
        $this->importFromWeb('digitalpublicationarticles');
        $this->importFromWeb('printedpublications');

        $this->importFromWeb('staticpages');
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

    protected function query($endpoint, $page = 1, $limit = 10)
    {
        if (config('aic.web.username')) {
            $this->auth = config('aic.web.username') . ':' . config('aic.web.password');
        }

        return parent::query($endpoint, $page, $limit);
    }

    /**
     * If an artwork was updated, and if the primary image was updated, reimport the
     * image embeddings.
     *
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function afterSave($resource)
    {
        if (in_array(get_class($resource), [
            \App\Models\Web\Article::class,
            \App\Models\Web\Highlight::class,
            \App\Models\Web\LandingPage::class,
            \App\Models\Web\DigitalPublicationArticle::class,
            \App\Models\Web\PrintedPublication::class,
        ])) {
            $this->generateAndSaveWebEmbeddngs($resource, $this);
        }
        return $resource;
    }
}
