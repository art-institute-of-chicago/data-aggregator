<?php

use Illuminate\Database\Seeder;

use App\Models\Dsc\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Section::class, 50 )->create();
    }
}
