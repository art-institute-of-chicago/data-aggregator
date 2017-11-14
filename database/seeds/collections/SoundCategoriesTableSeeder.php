<?php

use App\Models\Collections\Sound;
use App\Models\Collections\Category;

class SoundCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedBelongsToMany( Sound::class, Category::class, 'categories' );

    }

}
