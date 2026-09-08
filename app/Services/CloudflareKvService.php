<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class CloudflareKvService
{
    public function bulkPut(array $entries): void
    {
        $accountId = config('services.cloudflare.account_id');
        $namespaceId = config('services.cloudflare.kv_namespace_id');
        $token = config('services.cloudflare.api_token');

        $url = "https://api.cloudflare.com/client/v4/accounts/{$accountId}/storage/kv/namespaces/{$namespaceId}/bulk";

        $response = Http::withToken($token)->put($url, $entries);

        if (!$response->successful()) {
            throw new Exception('Cloudflare KV bulk write failed: ' . $response->status() . ' ' . $response->body());
        }
    }
}
