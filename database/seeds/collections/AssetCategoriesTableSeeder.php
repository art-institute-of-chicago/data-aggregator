<?php

use App\Models\Collections\Asset;
use App\Models\Collections\Category;

class AssetCategoriesTableSeeder extends AbstractSeeder
{

    public function seed()
    {

        $this->seedRelation(Asset::class, Category::class, 'categories');

    }

}
