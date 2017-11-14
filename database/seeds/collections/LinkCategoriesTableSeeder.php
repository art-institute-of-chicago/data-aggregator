<?php

use App\Models\Collections\Link;
use App\Models\Collections\Category;

class LinkCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedRelation( Link::class, Category::class, 'categories' );

    }

}
