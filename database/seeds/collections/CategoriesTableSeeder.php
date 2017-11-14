<?php

use App\Models\Collections\Category;

class CategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Category::class, 25 )->create();

        $this->seedBelongsTo( Category::class, Category::class, 'parent' );

    }

}
