<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\Category;

class ArtworkCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedBelongsToMany( Artwork::class, Category::class, 'categories' );

    }

}
