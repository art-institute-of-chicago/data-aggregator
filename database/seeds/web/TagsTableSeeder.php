<?php

use App\Models\Web\Tag;

class TagsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Tag::class, 25 )->create();

    }

}
