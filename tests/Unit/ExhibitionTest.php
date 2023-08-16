<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Collections\Exhibition;
use App\Models\Collections\ArtworkType;
use App\Models\Collections\Gallery;
use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;
use App\Models\Web\Exhibition as WebExhibition;

class ExhibitionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_provides_position_field(): void
    {
        $exhibition = $this->make(Exhibition::class);
        $exhibitionKey = $exhibition->getAttributeValue($exhibition->getKeyName());
        $this->make(WebExhibition::class, ['position' => 4, 'datahub_id' => $exhibitionKey]);

        $response = $this->getJson('api/v1/exhibitions/' . $exhibitionKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertEquals(4, $resource['position']);
    }
}
