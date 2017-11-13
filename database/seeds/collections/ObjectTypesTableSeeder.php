<?php

use App\Models\Collections\ObjectType;

class ObjectTypesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( ObjectType::class, 25 )->create();
    }

}
