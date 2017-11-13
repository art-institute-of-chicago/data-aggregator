<?php

use App\Models\Collections\Theme;

class ThemesTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Theme::class, 15 )->create();
    }
}
