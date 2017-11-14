<?php

use App\Models\Collections\Video;
use App\Models\Collections\Category;

class VideoCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedBelongsToMany( Video::class, Category::class, 'categories' );

    }

}
