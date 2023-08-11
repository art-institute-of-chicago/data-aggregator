<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Web\DigitalPublicationSection;

class DigitalPublicationSectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_inserts_long_text_in_the_copy_field(): void
    {
        $digitalPublictionSection = $this->make(DigitalPublicationSection::class, ['copy' => fake()->text(66000)]); // Longer than a `text` field
        $digitalPublictionSectionKey = $digitalPublictionSection->getAttributeValue($digitalPublictionSection->getKeyName());

        $response = $this->getJson('api/v1/digital-publication-sections/' . $digitalPublictionSectionKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertGreaterThan(65535, strlen($resource['copy']));
    }
}
