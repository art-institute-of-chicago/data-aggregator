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

        $this->it_fetches_mutliple(Video::class, 'videos');

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


    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(4),
            'title' => $this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
