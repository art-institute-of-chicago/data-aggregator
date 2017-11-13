<?php

use App\Models\Dsc\Section;

class SectionsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Section::class, 50 )->create();
    }
}
