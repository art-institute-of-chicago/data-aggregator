<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Collections\Image;

class ImportAssetsIiifGeometryCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['aic.assets.iiif_url' => 'https://example.com/iiif/2']);
    }

    private function fakeInfoJsonResponse(): array
    {
        return [
            'width' => 557,
            'height' => 768,
            'tiles' => [
                ['width' => 256, 'height' => 256, 'scaleFactors' => [1, 2, 4, 8]],
            ],
        ];
    }

    #[Test]
    public function it_only_fetches_new_or_stale_images_by_default(): void
    {
        $new = $this->make(Image::class);

        $upToDate = $this->make(Image::class);
        DB::table('assets')->where('id', $upToDate->id)->update([
            'iiif_synced_at' => now()->subHour(),
            'updated_at' => now()->subDay(),
        ]);

        $stale = $this->make(Image::class);
        DB::table('assets')->where('id', $stale->id)->update([
            'iiif_synced_at' => now()->subDay(),
            'updated_at' => now(),
        ]);

        Http::fake([
            '*/info.json' => Http::response($this->fakeInfoJsonResponse()),
        ]);

        $this->artisan('import:assets-iiif-geometry', ['--dry-run' => true])
            ->assertSuccessful();

        Http::assertSentCount(2);

        Http::assertSent(fn ($request) => $request->url() === $new->iiif_url . '/info.json');
        Http::assertSent(fn ($request) => $request->url() === $stale->iiif_url . '/info.json');
        Http::assertNotSent(fn ($request) => $request->url() === $upToDate->iiif_url . '/info.json');

        $new->refresh();
        $this->assertSame(557, $new->width);
        $this->assertSame(768, $new->height);
        $this->assertSame(256, $new->tile_width);
        $this->assertSame(256, $new->tile_height);
        $this->assertSame([1, 2, 4, 8], $new->scale_factors);
        $this->assertNotNull($new->iiif_synced_at);
    }

    #[Test]
    public function it_resyncs_every_image_with_the_full_flag(): void
    {
        $upToDate = $this->make(Image::class);
        DB::table('assets')->where('id', $upToDate->id)->update([
            'iiif_synced_at' => now()->subHour(),
            'updated_at' => now()->subDay(),
        ]);

        Http::fake([
            '*/info.json' => Http::response($this->fakeInfoJsonResponse()),
        ]);

        $this->artisan('import:assets-iiif-geometry', ['--full' => true, '--dry-run' => true])
            ->assertSuccessful();

        Http::assertSentCount(1);
    }

    #[Test]
    public function it_does_not_push_to_cloudflare_kv_on_a_dry_run(): void
    {
        $this->make(Image::class);

        Http::fake([
            '*/info.json' => Http::response($this->fakeInfoJsonResponse()),
            'api.cloudflare.com/*' => Http::response(['success' => true]),
        ]);

        $this->artisan('import:assets-iiif-geometry', ['--dry-run' => true])
            ->assertSuccessful();

        Http::assertNotSent(fn ($request) => str_contains($request->url(), 'api.cloudflare.com'));
    }
}
