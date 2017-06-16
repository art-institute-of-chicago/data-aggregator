<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Video;

use Tests\Helpers\Factory;

class VideoTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_videos()
    {

        $this->it_fetches_all(Video::class, 'videos');
        
    }

    /** @test */
    public function it_fetches_a_single_video()
    {

        $this->it_fetches_a_single(Video::class, 'videos');

    }

    /** @test */
    public function it_fetches_multiple_videos()
    {

        $this->it_fetches_multiple(Video::class, 'videos');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Video::class, 'videos');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Video::class, 'videos');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Video::class, 'videos');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Video::class, 'videos');
        
    }
    
}
