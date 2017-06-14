<?php

use Illuminate\Database\Seeder;

class LinkCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $links = App\Collections\Link::all()->all();
        $categoryIds = App\Collections\Category::all()->pluck('lake_guid')->all();

        foreach ($links as $link) {

            for ($i = 0; $i < rand(2,8); $i++) {
                $link->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }
        
    }
    
}
