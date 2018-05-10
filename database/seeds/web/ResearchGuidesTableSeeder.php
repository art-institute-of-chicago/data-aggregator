<?php

use App\Models\Web\ResearchGuide;

class ResearchGuidesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( ResearchGuide::class, 25 )->create();

    }

}
