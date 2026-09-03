<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Http;
use App\Services\CloudflareKvService;
use Exception;

class CloudflareKvServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.cloudflare.account_id' => 'acct-123',
            'services.cloudflare.kv_namespace_id' => 'ns-456',
            'services.cloudflare.api_token' => 'token-789',
        ]);
    }

    #[Test]
    public function it_bulk_puts_entries_to_the_correct_endpoint_with_the_expected_body(): void
    {
        Http::fake([
            'api.cloudflare.com/*' => Http::response(['success' => true]),
        ]);

        $entries = [
            ['key' => 'abc-123', 'value' => '{"w":100}'],
            ['key' => 'def-456', 'value' => '{"w":200}'],
        ];

        (new CloudflareKvService())->bulkPut($entries);

        $expectedUrl = 'https://api.cloudflare.com/client/v4/accounts/acct-123/storage/kv/namespaces/ns-456/bulk';

        Http::assertSent(function ($request) use ($entries, $expectedUrl) {
            return $request->url() === $expectedUrl
                && $request->method() === 'PUT'
                && $request->hasHeader('Authorization', 'Bearer token-789')
                && $request->data() === $entries;
        });
    }

    #[Test]
    public function it_throws_when_the_response_is_not_successful(): void
    {
        Http::fake([
            'api.cloudflare.com/*' => Http::response(['success' => false], 500),
        ]);

        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/Cloudflare KV bulk write failed: 500/');

        (new CloudflareKvService())->bulkPut([['key' => 'abc-123', 'value' => '{}']]);
    }
}
