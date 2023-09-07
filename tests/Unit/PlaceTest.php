<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Collections\Place;

class PlaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_provides_ccby_licensing_details(): void
    {
        $place = $this->make(Place::class);
        $placeKey = $place->getAttributeValue($place->getKeyName());

        $response = $this->getJson('api/v1/places/' . $placeKey);
        $response->assertSuccessful();

        $resource = $response->json()['info'];
        $this->assertStringContainsString('CC-By', $resource['license_text']);
        $this->assertStringNotContainsString('CC0', $resource['license_text']);
        $this->assertStringContainsString('Getty Thesaurus of Geographic Names', $resource['license_text']);

        $response = $this->getJson('api/v1/places');
        $response->assertSuccessful();

        $resource = $response->json()['info'];
        $this->assertStringContainsString('CC-By', $resource['license_text']);
        $this->assertStringNotContainsString('CC0', $resource['license_text']);
        $this->assertStringContainsString('Getty Thesaurus of Geographic Names', $resource['license_text']);
    }
}
