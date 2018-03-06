<?php

namespace Tests\Unit;

use App\Models\Mobile\Tour;
use App\Models\Mobile\Sound;

class TourTest extends ApiTestCase
{

    protected $model = Tour::class;

    public function setUp()
    {

        parent::setUp();
        $this->make(Sound::class);

    }

}
