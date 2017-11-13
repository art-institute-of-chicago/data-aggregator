<?php

use App\Models\Collections\Link;
use App\Models\Collections\Category;

class LinkCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedPivot( Link::class, Category::class, 'categories' );

    }

}
