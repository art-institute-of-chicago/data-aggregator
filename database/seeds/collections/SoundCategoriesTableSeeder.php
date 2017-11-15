<?php

use App\Models\Collections\Sound;
use App\Models\Collections\Category;

class SoundCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedRelation( Sound::class, Category::class, 'categories' );

    }

}
