<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\Category;

class ArtworkCategoriesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->seedRelation(Artwork::class, Category::class, 'categories');
    }

}
