<?php

namespace Tests\Unit;

use App\Models\Mobile\Sound;

class MobileSoundTest extends ApiTestCase
{

    protected $model = Sound::class;

    protected $route = 'mobile-sounds';

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Sound::class, 'mobile-sounds', true);

    }

}
