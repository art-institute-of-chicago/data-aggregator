<?php

use App\Models\Collections\ObjectType;

class ObjectTypesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( ObjectType::class, 25 )->create();
    }
}
