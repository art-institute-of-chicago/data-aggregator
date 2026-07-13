<?php

namespace App\Transformers\Inbound\Archive;

use App\Transformers\Datum;
use App\Transformers\Inbound\BaseTransformer;

class Archive extends BaseTransformer
{
    /**
     * Don't passthrough all fields — we map explicitly since the
     * data-service API field names match our DB column names.
     * Override passthroughExceptions to allow id through.
     */
    protected $passthrough = true;

    protected function getSync(Datum $datum)
    {
        return [
            'agents' => $datum->agent_citi_ids ?? [],
        ];
    }
}
