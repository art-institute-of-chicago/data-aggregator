<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\Category;

class ArtworkCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedPivot( Artwork::class, Category::class, 'categories' );

    }

}
