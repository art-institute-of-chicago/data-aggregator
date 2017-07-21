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

        $this->clean();

        $this->call(ShopCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

    }

    private function clean()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        App\Models\Shop\Product::truncate();
        App\Models\Shop\Category::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}