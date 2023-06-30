<?php

namespace Tests\Basic;

use App\Models\Web\GenericPage;

class GenericPageTest extends BasicTestCase
{
    protected $model = GenericPage::class;

    protected $route = 'generic-pages';
}
