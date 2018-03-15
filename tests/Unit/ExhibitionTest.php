<?php

namespace Tests\Unit;

use App\Models\Collections\Exhibition;
use App\Models\Collections\Place;
use App\Models\Collections\Artwork;
use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;
use App\Models\Collections\AgentExhibition;

class ExhibitionTest extends ApiTestCase
{

    protected $model = Exhibition::class;

    protected $keys = ['lake_guid'];

    protected $fieldsUsedByMobile = ['id',
                                     'title',
                                     'description',
                                     'short_description',
                                     'web_url',
                                     'aic_start_at',
                                     'aic_end_at',
                                     'image_iiif_url',
                                     'gallery_id',
    ];

    public function setUp()
    {

        parent::setUp();
        $this->make(Place::class, ['type' => 'AIC Gallery']);
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

        $exhibitionId = $this->attach(AgentExhibition::class, 4, 'venues')->make(Exhibition::class);

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
