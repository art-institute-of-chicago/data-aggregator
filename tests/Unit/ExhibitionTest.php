<?php

namespace Tests\Unit;

use App\Models\Collections\Exhibition;
use App\Models\Collections\Gallery;
use App\Models\Collections\Department;
use App\Models\Collections\Artwork;
use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;

class ExhibitionTest extends ApiTestCase
{

    protected $model = Exhibition::class;

    protected $route = 'exhibitions';

    protected $keys = ['lake_guid'];

    public function setUp()
    {

        parent::setUp();
        $this->make(Gallery::class);
        $this->make(Department::class);
        $this->times(5)->make(Agent::class);

    }

    /** @test */
    public function it_fetches_artworks_for_an_exhibition()
    {

        $exhibitionId = $this->attach(Artwork::class, 4)->make(Exhibition::class);

        $response = $this->getJson('api/v1/exhibitions/' .$exhibitionId .'/artworks');
        $response->assertSuccessful();

        $artworks = $response->json()['data'];
        $this->assertCount(4, $artworks);

        foreach ($artworks as $artwork)
        {
            $this->assertArrayHasKeys($artwork, ['id', 'title']);
        }
    }


    /** @test */
    public function it_fetches_venues_for_an_exhibition()
    {

        $corporateBodyAgentType = $this->make(AgentType::class, ['title' => 'Corporate Body']);
        $exhibitionId = $this->attach(Agent::class, 4, 'venues', ['agent_type_citi_id' => $corporateBodyAgentType])->make(Exhibition::class);

        $response = $this->getJson('api/v1/exhibitions/' .$exhibitionId .'/venues');
        $response->assertSuccessful();

        $venues = $response->json()['data'];
        $this->assertCount(4, $venues);

        foreach ($venues as $venue)
        {
            $this->assertArrayHasKeys($venue, ['id', 'title']);
        }
    }

}
