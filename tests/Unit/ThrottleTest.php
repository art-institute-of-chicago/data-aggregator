<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class ThrottleTest extends TestCase
{
    private const ENDPOINT = 'api/v1/artworks/999999999';

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'aic.auth.restricted' => true,
            'aic.auth.max_attempts' => 2,
            'aic.auth.access_whitelist_ips' => ['10.0.0.0/8'],
        ]);
    }

    public static function endpointProvider(): array
    {
        return [
            'api' => [self::ENDPOINT],
            'ai' => ['ai/v1'],
            'la' => ['la/v1/objects/999999999'],
            'csv' => ['csv/v1/artworks/999999999'],
        ];
    }

    #[Test]
    #[DataProvider('endpointProvider')]
    public function it_throttles_anonymous_users(string $endpoint): void
    {
        config(['azure.status' => true]);

        $this->requestFrom('192.0.2.1', $endpoint)->assertHeader('X-RateLimit-Limit', 2);
        $this->requestFrom('192.0.2.1', $endpoint)->assertHeader('X-RateLimit-Remaining', 0);
        $this->requestFrom('192.0.2.1', $endpoint)->assertStatus(429);
    }

    #[Test]
    public function it_throttles_each_ip_separately(): void
    {
        $this->requestFrom('192.0.2.1');
        $this->requestFrom('192.0.2.1');
        $this->requestFrom('192.0.2.1')->assertStatus(429);

        $this->requestFrom('192.0.2.2')->assertNotFound();
    }

    #[Test]
    public function it_does_not_throttle_whitelisted_ips(): void
    {
        foreach (range(1, 3) as $i) {
            $this->requestFrom('10.1.2.3')
                ->assertNotFound()
                ->assertHeaderMissing('X-RateLimit-Limit');
        }
    }

    #[Test]
    public function it_does_not_throttle_when_unrestricted(): void
    {
        config(['aic.auth.restricted' => false]);

        foreach (range(1, 3) as $i) {
            $this->requestFrom('192.0.2.1')->assertNotFound();
        }
    }

    private function requestFrom(string $ip, string $endpoint = self::ENDPOINT)
    {
        return $this->withServerVariables(['REMOTE_ADDR' => $ip])->getJson($endpoint);
    }
}
