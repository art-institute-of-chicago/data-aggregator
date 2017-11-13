<?php

use App\Models\Collections\ObjectType;

class ObjectTypesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( ObjectType::class, 25 )->create();
    }
}
