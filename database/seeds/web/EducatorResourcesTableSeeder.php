<?php

use App\Models\Web\EducatorResource;

class EducatorResourcesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(EducatorResource::class, 25)->create();
    }

}
