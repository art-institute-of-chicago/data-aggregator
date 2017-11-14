<?php

use App\Models\Shop\Category;

class ShopCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Category::class, 25 )->create();

        $this->seedHasMany( Category::class, Category::class, 'children' );

    }

}
