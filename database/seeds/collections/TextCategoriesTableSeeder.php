<?php

use App\Models\Collections\Text;
use App\Models\Collections\Category;

class TextCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedPivot( Text::class, Category::class, 'categories' );

    }

}
