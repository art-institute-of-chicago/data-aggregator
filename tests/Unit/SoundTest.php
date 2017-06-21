<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Sound;

class SoundTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_sounds()
    {

        $this->it_fetches_all(Sound::class, 'sounds');
        
    }

    /** @test */
    public function it_fetches_a_single_sound()
    {

        $this->it_fetches_a_single(Sound::class, 'sounds');

    }

    /** @test */
    public function it_fetches_multiple_sounds()
    {

        $this->it_fetches_multiple(Sound::class, 'sounds');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Sound::class, 'sounds');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Sound::class, 'sounds');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Sound::class, 'sounds', true);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Sound::class, 'sounds');
        
    }
    
}
