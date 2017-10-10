<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Collections\Video;

class VideoTest extends ApiTestCase
{

    protected $model = Video::class;

    protected $route = 'videos';

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Video::class, 'videos', true);

    }

}
