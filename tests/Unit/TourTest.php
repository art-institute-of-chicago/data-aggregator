<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Mobile\Tour;
use App\Models\Mobile\Sound;

class TourTest extends ApiTestCase
{

    protected $model = Tour::class;

    protected $route = 'tours';

    public function setUp()
    {

        parent::setUp();
        $this->make(Sound::class);

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Tour::class, 'tours', true);

    }

}
