<?php

use App\Models\Collections\Category;

class CategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Category::class, 25 )->create();

        $this->seedRelation( Category::class, Category::class, 'parent' );

        // Alternatively, you can call this, for demonstration purposes:
        // $this->seedRelation( Category::class, Category::class, 'children' );

    }

}
