<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Gallery;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Gallery::class, 25 )->create();
    }
}
