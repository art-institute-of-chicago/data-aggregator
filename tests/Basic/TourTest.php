<?php

namespace Tests\Basic;

use App\Models\Mobile\Tour;
use App\Models\Mobile\Sound;

class TourTest extends BasicTestCase
{

    protected $model = Tour::class;

    protected function setUp(): void
    {
        parent::setUp();
        $this->make(Sound::class);
    }
}
