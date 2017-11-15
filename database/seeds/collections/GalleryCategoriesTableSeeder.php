<?php

use App\Models\Collections\Gallery;
use App\Models\Collections\Category;

class GalleryCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedRelation( Gallery::class, Category::class, 'categories' );

    }

}
