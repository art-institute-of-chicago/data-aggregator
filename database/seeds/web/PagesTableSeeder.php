<?php

use App\Models\Web\Page;

class PagesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Page::class, 25 )->create();

    }

}
