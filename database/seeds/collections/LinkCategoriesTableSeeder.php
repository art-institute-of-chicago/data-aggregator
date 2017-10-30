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

        $links = App\Models\Collections\Link::fake()->get();
        $categoryIds = App\Models\Collections\Category::fake()->pluck('citi_id')->all();

        foreach ($links as $link) {

            for ($i = 0; $i < rand(2,4); $i++) {
                $link->categories()->attach($categoryIds[array_rand($categoryIds)]);
            }

        }

    }

}
