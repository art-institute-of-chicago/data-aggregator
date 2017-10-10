<?php

namespace Tests\Unit;

use App\Models\Collections\Text;

class TextTest extends ApiTestCase
{

    protected $model = Text::class;

    protected $route = 'texts';

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Text::class, 'texts', true);

    }

}
