<?php

use App\Models\Collections\Theme;

class ThemesTableSeeder extends AbstractSeeder
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
