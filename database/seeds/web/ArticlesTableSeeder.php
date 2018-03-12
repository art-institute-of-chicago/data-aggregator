<?php

use App\Models\Web\Closure;

class ArticlesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Article::class, 25 )->create();

    }

}
