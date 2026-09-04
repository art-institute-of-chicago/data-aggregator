<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Http;
use App\Services\IiifGeometryService;

class IiifGeometryServiceTest extends TestCase
{
    #[Test]
    public function it_parses_geometry_from_a_successful_info_json(): void
    {
        Http::fake([
            'https://example.com/iiif/2/some-id/info.json' => Http::response([
                'width' => 557,
                'height' => 768,
                'tiles' => [
                    ['width' => 256, 'height' => 256, 'scaleFactors' => [1, 2, 4, 8]],
                ],
            ]),
        ]);

        $result = (new IiifGeometryService())->fetch('https://example.com/iiif/2/some-id');

        $this->assertSame([
            'width' => 557,
            'height' => 768,
            'tile_width' => 256,
            'tile_height' => 256,
            'scale_factors' => [1, 2, 4, 8],
        ], $result);
    }

    #[Test]
    public function it_returns_null_when_the_request_fails(): void
    {
        Http::fake([
            'https://example.com/iiif/2/missing-id/info.json' => Http::response(null, 404),
        ]);

        $result = (new IiifGeometryService())->fetch('https://example.com/iiif/2/missing-id');

        $this->assertNull($result);
    }

    #[Test]
    public function it_returns_null_on_a_server_error(): void
    {
        Http::fake([
            'https://example.com/iiif/2/broken-id/info.json' => Http::response(null, 500),
        ]);

        $result = (new IiifGeometryService())->fetch('https://example.com/iiif/2/broken-id');

        $this->assertNull($result);
    }
}
