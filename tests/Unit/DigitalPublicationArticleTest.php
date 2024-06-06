<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Web\DigitalPublicationArticle;

class DigitalPublicationArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_inserts_long_text_in_the_copy_field(): void
    {
        $digitalPublictionArticle = $this->make(DigitalPublicationArticle::class, ['copy' => fake()->text(66000)]); // Longer than a `text` field
        $digitalPublictionArticleKey = $digitalPublictionArticle->getAttributeValue($digitalPublictionArticle->getKeyName());

        $response = $this->getJson('api/v1/digital-publication-articles/' . $digitalPublictionArticleKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertGreaterThan(65535, strlen($resource['copy']));
    }
}
