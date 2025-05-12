<?php

namespace Tests\Basic;

use App\Models\Web\LandingPage;

class LandingPageTest extends BasicTestCase
{
    protected $model = LandingPage::class;

    protected $route = 'landing-pages';
}
