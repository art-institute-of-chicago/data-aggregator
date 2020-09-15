<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Models\Collections\Artwork;
use App\Models\Collections\Gallery;
use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;

class ArtworkTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $agentType = $this->make(AgentType::class, ['title' => 'Individual']);
        $agent = $this->make(Agent::class, ['agent_type_citi_id' => $agentType->citi_id]);
    }

    protected function tearDown(): void
    {
        AgentType::query()->delete();
        Agent::query()->delete();

        parent::tearDown();
    }

    /** @test */
    public function it_fetches_the_gallery_for_an_artwork()
    {
        $gallery = $this->make(Gallery::class, ['is_closed' => false]);
        $galleryKey = $gallery->getAttributeValue($gallery->getKeyName());

        $artwork = $this->make(Artwork::class, ['gallery_citi_id' => $galleryKey, 'is_on_view' => true]);
        $artworkKey = $artwork->getAttributeValue($artwork->getKeyName());

        $response = $this->getJson('api/v1/artworks/' . $artworkKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertTrue($resource['is_on_view']);

        Artwork::query()->delete();
        Gallery::query()->delete();
    }
}
