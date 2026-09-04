<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IiifGeometryService
{
    public const MAX_RETRIES = 3;
    public const TIMEOUT_SECONDS = 10;

    /**
     * Fetches and parses `{iiifUrl}/info.json`, returning geometry fields
     * ready to assign onto an Image model, or null if the identifier has
     * no reachable info.json (e.g. asset was deleted/never digitized).
     */
    public function fetch(string $iiifUrl): ?array
    {
        $response = Http::timeout(self::TIMEOUT_SECONDS)
            ->retry(self::MAX_RETRIES, 500, throw: false)
            ->get($iiifUrl . '/info.json');

        if (!$response->successful()) {
            return null;
        }

        $info = $response->json();
        $tile = $info['tiles'][0] ?? null;

        return [
            'width' => $info['width'] ?? null,
            'height' => $info['height'] ?? null,
            'tile_width' => $tile['width'] ?? null,
            'tile_height' => $tile['height'] ?? null,
            'scale_factors' => $tile['scaleFactors'] ?? null,
        ];
    }
}
