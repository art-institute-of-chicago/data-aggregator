<?php

use App\Models\Web\Hour;
use App\Models\Web\Closure;
use App\Models\Web\Exhibition;
use App\Models\Web\Event;
use App\Models\Web\EventProgram;
use App\Models\Web\Article;
use App\Models\Web\Selection;
use App\Models\Web\Artist;
use App\Models\Web\GenericPage;
use App\Models\Web\PressRelease;
use App\Models\Web\EducatorResource;
use App\Models\Web\DigitalCatalog;
use App\Models\Web\PrintedCatalog;

class WebDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->call(HoursTableSeeder::class);
        $this->call(ClosuresTableSeeder::class);
        $this->call(WebExhibitionsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EventProgramsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(SelectionsTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(GenericPagesTableSeeder::class);
        $this->call(PressReleasesTableSeeder::class);
        $this->call(EducatorResourcesTableSeeder::class);
        $this->call(DigitalCatalogsTableSeeder::class);
        $this->call(PrintedCatalogsTableSeeder::class);
    }

    protected static function unseed()
    {
        Hour::query()->delete();
        Closure::query()->delete();
        Exhibition::query()->delete();
        EventProgram::query()->delete();
        Event::query()->delete();
        Article::query()->delete();
        Selection::query()->delete();
        Artist::query()->delete();
        GenericPage::query()->delete();
        PressRelease::query()->delete();
        EducatorResource::query()->delete();
        DigitalCatalog::query()->delete();
        PrintedCatalog::query()->delete();
    }

}
