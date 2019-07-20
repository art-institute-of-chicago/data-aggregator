<?php

use App\Models\Collections\Place;
use App\Models\Collections\Category;

class PlaceCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedRelation(Place::class, Category::class, 'categories');

    }

}
