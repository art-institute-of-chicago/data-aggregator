<?php

namespace Tests\Basic;

use App\Models\Collections\Exhibition;
use App\Models\Collections\Gallery;
use App\Models\Collections\Agent;

class ExhibitionTest extends BasicTestCase
{

    protected $model = Exhibition::class;

    protected function setUp(): void
    {
        parent::setUp();
        $this->make(Gallery::class);
        $this->times(5)->make(Agent::class);
    }
}
