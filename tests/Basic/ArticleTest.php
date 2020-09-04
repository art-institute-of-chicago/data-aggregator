<?php

namespace Tests\Basic;

use App\Models\Web\Article;

class ArticleTest extends BasicTestCase
{

    protected $model = Article::class;

    protected $route = 'articles';
}
