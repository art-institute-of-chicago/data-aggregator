<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThrottleTest extends TestCase
{
    use RefreshDatabase;

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

    #[Test]
    public function it_throttles_anonymous_users(): void
    {
        $this->requestFrom('192.0.2.1')->assertHeader('X-RateLimit-Limit', 2);
        $this->requestFrom('192.0.2.1')->assertHeader('X-RateLimit-Remaining', 0);
        $this->requestFrom('192.0.2.1')->assertStatus(429);
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

    private function requestFrom(string $ip)
    {
        return $this->withServerVariables(['REMOTE_ADDR' => $ip])->getJson(self::ENDPOINT);
    }
}
