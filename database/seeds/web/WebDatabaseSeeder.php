<?php

use App\Models\Web\Tag;
use App\Models\Web\Location;
use App\Models\Web\Hour;
use App\Models\Web\Closure;
use App\Models\Web\Article;
use App\Models\Web\Selection;

class WebDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(TagsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(HoursTableSeeder::class);
        $this->call(ClosuresTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(SelectionsTableSeeder::class);

    }

    protected static function unseed()
    {

        Tag::fake()->delete();
        Location::fake()->delete();
        Hour::fake()->delete();
        Closure::fake()->delete();
        Article::fake()->delete();
        Selection::fake()->delete();

    }

}
