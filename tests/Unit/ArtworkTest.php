<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkType;
use App\Models\Collections\Gallery;
use App\Models\Collections\AgentType;
use App\Models\Collections\Agent;

class ArtworkTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $agentType = $this->make(AgentType::class, ['title' => 'Individual']);
        $agent = $this->make(Agent::class, ['agent_type_id' => $agentType->id]);
    }

    /** @test */
    public function it_fetches_the_gallery_for_an_artwork(): void
    {
        $gallery = $this->make(Gallery::class, ['is_closed' => false]);
        $galleryKey = $gallery->getAttributeValue($gallery->getKeyName());

        $artwork = $this->make(Artwork::class, ['gallery_id' => $galleryKey, 'is_on_view' => true]);
        $artworkKey = $artwork->getAttributeValue($artwork->getKeyName());

        $response = $this->getJson('api/v1/artworks/' . $artworkKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertTrue($resource['is_on_view']);
    }

    /** @test */
    public function it_fetches_artwork_linked_art_endpoint(): void
    {
        $artworkType = $this->make(ArtworkType::class, ['aat_id' => '300033618', 'title' => 'Painting']);
        $artworkTypeKey = $artworkType->getAttributeValue($artworkType->getKeyName());

        $artwork = $this->make(Artwork::class, ['artwork_type_id' => $artworkTypeKey]);
        $artworkKey = $artwork->getAttributeValue($artwork->getKeyName());

        $response = $this->getJson('la/v1/objects/' . $artworkKey);
        $response->assertSuccessful();

        $resource = $response->json();
        $this->assertCount(1, $resource['classified_as']);
        $this->assertEquals($resource['classified_as'][0]['id'], 'http://vocab.getty.edu/aat/300033618');
    }

    /** @test */
    public function it_fetches_multiple_artwork_linked_art_endpoint(): void
    {
        $artwork1Type = $this->make(ArtworkType::class, ['aat_id' => '300033618', 'title' => 'Painting']);
        $artwork1TypeKey = $artwork1Type->getAttributeValue($artwork1Type->getKeyName());

        $artwork1 = $this->make(Artwork::class, ['artwork_type_id' => $artwork1TypeKey]);
        $artwork1Key = $artwork1->getAttributeValue($artwork1->getKeyName());

        $artwork2Type = $this->make(ArtworkType::class, ['aat_id' => '300193015', 'title' => 'Vessel']);
        $artwork2TypeKey = $artwork2Type->getAttributeValue($artwork2Type->getKeyName());

        $artwork2 = $this->make(Artwork::class, ['artwork_type_id' => $artwork2TypeKey]);
        $artwork2Key = $artwork2->getAttributeValue($artwork2->getKeyName());

        $response = $this->getJson('la/v1/objects?ids=' . $artwork1Key . ',' . $artwork2Key);
        $response->assertSuccessful();

        $resource = $response->json();
        $this->assertCount(2, $resource['objects']);

        $idsInResponse = array_merge(array_keys($resource['objects'][0]), array_keys($resource['objects'][1]));
        $this->assertContains($artwork1Key, $idsInResponse, 'The works we added to the database are not in the repsonse');

        $artwork1Response = array_pop($resource['objects'][0]);
        $artwork2Response = array_pop($resource['objects'][1]);
        $this->assertCount(1, $artwork1Response['classified_as'], 'The works do not include expected data');
        $this->assertCount(1, $artwork2Response['classified_as'], 'The works do not include expected data');

        $classifiedIdsInResponse = [$artwork1Response['classified_as'][0]['id'], $artwork2Response['classified_as'][0]['id']];
        $this->assertContains('http://vocab.getty.edu/aat/300033618', $classifiedIdsInResponse);
        $this->assertContains('http://vocab.getty.edu/aat/300193015', $classifiedIdsInResponse);
    }

    /** @test */
    public function it_provides_cc0_licensing_details(): void
    {
        $artwork = $this->make(Artwork::class);
        $artworkKey = $artwork->getAttributeValue($artwork->getKeyName());

        $response = $this->getJson('api/v1/artworks/' . $artworkKey);
        $response->assertSuccessful();

        $resource = $response->json()['info'];
        $this->assertStringContainsString('The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By)', $resource['license_text']);
        $this->assertStringContainsString('All other data in this response is licensed under a Creative Commons Zero (CC0)', $resource['license_text']);

        $response = $this->getJson('api/v1/artworks');
        $response->assertSuccessful();

        $resource = $response->json()['info'];
        $this->assertStringContainsString('The `description` field in this response is licensed under a Creative Commons Attribution 4.0 Generic License (CC-By)', $resource['license_text']);
        $this->assertStringContainsString('All other data in this response is licensed under a Creative Commons Zero (CC0)', $resource['license_text']);
    }

    /** @test */
    public function it_provides_description_field(): void
    {
        $artwork = $this->make(Artwork::class, ['description' => fake()->paragraph(5)]);
        $artworkKey = $artwork->getAttributeValue($artwork->getKeyName());

        $response = $this->getJson('api/v1/artworks/' . $artworkKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertNotEmpty($resource['description']);
    }
}
