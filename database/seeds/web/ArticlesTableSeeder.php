<?php

use App\Models\Web\Article;

class ArticlesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Article::class, 25 )->create();

    }

}
