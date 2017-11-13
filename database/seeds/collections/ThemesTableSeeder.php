<?php

use App\Models\Collections\Theme;

class ThemesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Theme::class, 15 )->create();
    }

}
