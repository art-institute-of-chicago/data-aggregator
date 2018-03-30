<?php

namespace App\Console\Commands;

use DB;

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

        // Return false if the user bails out
        if (!$this->option('yes') && !$this->confirm("Running this will delete all existing web cms data from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all Publications and Sections from the search index
        $this->call("scout:flush", ['model' => Article::class]);
        $this->call("scout:flush", ['model' => Artist::class]);
        $this->call("scout:flush", ['model' => Closure::class]);
        $this->call("scout:flush", ['model' => Event::class]);
        $this->call("scout:flush", ['model' => Exhibition::class]);
        $this->call("scout:flush", ['model' => Hour::class]);
        $this->call("scout:flush", ['model' => Location::class]);
        //$this->call("scout:flush", ['model' => Page::class]);
        $this->call("scout:flush", ['model' => Selection::class]);
        $this->call("scout:flush", ['model' => Tag::class]);

        // Truncate tables
        DB::table('articles')->truncate();
        DB::table('web_artists')->truncate();
        DB::table('closures')->truncate();
        DB::table('events')->truncate();
        DB::table('web_exhibitions')->truncate();
        DB::table('hours')->truncate();
        DB::table('locations')->truncate();
        //DB::table('pages')->truncate();
        DB::table('selections')->truncate();
        DB::table('tags')->truncate();

        $this->info("Truncated web tables.");

        // Flush might not remove models that are present in the index, but not the database
        $this->info("Please manually ensure that your search index mappings are up-to-date. If there are models present "
                    . "in the index but not the database, they were not flushed.");

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

        $this->info("Imported all web CMS content!");

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
