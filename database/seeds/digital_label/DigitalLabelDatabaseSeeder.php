<?php

use App\Models\DigitalLabel\Label;
use App\Models\DigitalLabel\Exhibition;

class DigitalLabelDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->call(ExhibitionSeeder::class);
        $this->call(LabelSeeder::class);
    }

    protected static function unseed()
    {
        Label::fake()->delete();
        Exhibition::fake()->delete();
    }

}
