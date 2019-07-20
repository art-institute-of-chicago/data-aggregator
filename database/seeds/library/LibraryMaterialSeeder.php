<?php

use App\Models\Library\Material;

class LibraryMaterialSeeder extends AbstractSeeder
{

    public function seed()
    {

        factory(Material::class, 10)->create();

    }

}
