<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Collections\Term;

class TermTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_provides_cc0_licensing_details(): void
    {
        $term = $this->make(Term::class);
        $termKey = $term->getAttributeValue($term->getKeyName());

        $response = $this->getJson('api/v1/terms/' . $termKey);
        $response->assertSuccessful();

        $resource = $response->json()['info'];
        $this->assertStringContainsString('CC0', $resource['license_text']);
        $this->assertStringNotContainsString('CC-By', $resource['license_text']);

        $response = $this->getJson('api/v1/terms');
        $response->assertSuccessful();

        $resource = $response->json()['info'];
        $this->assertStringContainsString('CC0', $resource['license_text']);
        $this->assertStringNotContainsString('CC-By', $resource['license_text']);
    }
}
