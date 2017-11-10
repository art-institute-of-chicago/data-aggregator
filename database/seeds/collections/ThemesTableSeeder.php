<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Theme;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Theme::class, 15 )->create();
    }
}
