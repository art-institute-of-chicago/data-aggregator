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

class ImportWebFull extends AbstractImportCommandNew
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
                // Page::class,
                Selection::class,
                Tag::class,
            ],
            [
                'articles',
                'web_artists',
                'closures',
                'events',
                'web_exhibitions',
                'hours',
                'locations',
                // 'pages',
                'selections',
                'tags',
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
        //$this->import(Page::class, 'pages');
        $this->import(Selection::class, 'selections');
        $this->import(Tag::class, 'tags');

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
