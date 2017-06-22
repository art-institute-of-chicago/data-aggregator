<?php

use Illuminate\Database\Seeder;

class ShopCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Shop\Category::class, 100)->create();
    }
}
