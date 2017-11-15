<?php

use App\Models\Collections\Video;
use App\Models\Collections\Category;

class VideoCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedRelation( Video::class, Category::class, 'categories' );

    }

}
