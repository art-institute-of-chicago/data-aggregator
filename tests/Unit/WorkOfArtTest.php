<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Dsc\WorkOfArt;
use App\Models\Dsc\Publication;
use App\Models\Collections\Artwork;
use App\Models\Collections\Agent;

class WorkOfArtTest extends ApiTestCase
{

    protected $model = WorkOfArt::class;

    protected $route = 'works-of-art';

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);
        $this->times(5)->make(Agent::class);
        $this->times(5)->attach(Agent::class, 2, 'artists')->make(Artwork::class);

    }

}
