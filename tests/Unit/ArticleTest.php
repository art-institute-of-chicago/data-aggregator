<?php

namespace Tests\Unit;

use App\Models\Web\Article;

class ArticleTest extends ApiTestCase
{

    protected $model = Article::class;

    protected $route = 'articles';

}
