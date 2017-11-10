<?php

use Illuminate\Database\Seeder;

use App\Models\Shop\Category;
use App\Models\Shop\Product;

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

        Category::fake()->delete();
        Product::fake()->delete();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}
