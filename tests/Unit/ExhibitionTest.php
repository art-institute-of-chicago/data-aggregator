<?php

namespace Tests\Unit;

use App\Models\Collections\Exhibition;
use App\Models\Web\Exhibition as WebExhibition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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

    /** @test */
    public function it_does_not_use_nocache_in_web_url_field(): void
    {
        $exhibition = $this->make(Exhibition::class);
        $exhibitionKey = $exhibition->getAttributeValue($exhibition->getKeyName());
        WebExhibition::factory()->withNocacheUrl()->create(['datahub_id' => $exhibitionKey]);

        $response = $this->getJson('api/v1/exhibitions/' . $exhibitionKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertStringNotContainsString('nocache.', $resource['web_url']);
    }
}
