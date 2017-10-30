<?php

use Illuminate\Database\Seeder;

class ShopDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ShopCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

    }

    public static function clean()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        App\Models\Shop\Category::fake()->delete();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        App\Models\Shop\Product::fake()->delete();

    }

}