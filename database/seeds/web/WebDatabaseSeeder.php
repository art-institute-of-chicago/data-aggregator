<?php

use App\Models\Web\Tag;
use App\Models\Web\Location;
use App\Models\Web\Hour;
use App\Models\Web\Closure;
use App\Models\Web\Exhibition;
use App\Models\Web\Event;
use App\Models\Web\Article;
use App\Models\Web\Selection;
use App\Models\Web\Artist;
use App\Models\Web\Page;

class WebDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(TagsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(HoursTableSeeder::class);
        $this->call(ClosuresTableSeeder::class);
        $this->call(WebExhibitionsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(SelectionsTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(PagesTableSeeder::class);

    }

    protected static function unseed()
    {

        Tag::fake()->delete();
        Location::fake()->delete();
        Hour::fake()->delete();
        Closure::fake()->delete();
        Exhibition::fake()->delete();
        Event::fake()->delete();
        Article::fake()->delete();
        Selection::fake()->delete();
        Artist::fake()->delete();
        Page::fake()->delete();

    }

}
