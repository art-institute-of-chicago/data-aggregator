<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Mobile\Sound;

class MobileSoundTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_all_sounds()
    {

        $resources = $this->it_fetches_all(Sound::class, 'mobile-sounds');

    }

    /** @test */
    public function it_fetches_a_single_sound()
    {

        $resource = $this->it_fetches_a_single(Sound::class, 'mobile-sounds');

    }

    /** @test */
    public function it_fetches_multiple_sounds()
    {

        $resources = $this->it_fetches_multiple(Sound::class, 'mobile-sounds');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Sound::class, 'mobile-sounds');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Sound::class, 'mobile-sounds');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Sound::class, 'mobile-sounds', true);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Sound::class, 'mobile-sounds');

    }

}
