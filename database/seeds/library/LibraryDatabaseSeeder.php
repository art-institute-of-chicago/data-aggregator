<?php

use App\Models\Library\Material;
use App\Models\Library\Term;

class LibraryDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->call(LibraryMaterialSeeder::class);
        $this->call(LibraryTermSeeder::class);
    }

    protected static function unseed()
    {
        Material::fake()->delete();
        Term::fake()->delete();
    }

}
