<?php

use App\Models\Collections\Image;
use App\Models\Collections\Category;

class ImageCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedBelongsToMany( Image::class, Category::class, 'categories' );

    }

}
