<?php

namespace App\Transformers\Inbound\ArtistEnrichment;

use App\Transformers\Datum;
use App\Transformers\Inbound\Enhancer\AbstractEnhancerTransformer as BaseTransformer;

class Agent extends BaseTransformer
{
    protected function getExtraFields(Datum $datum)
    {
        $vocabIds = $datum->vocab_ids;

        return [
            'vocab_ids' => $vocabIds ? $vocabIds->all() : null,
            'wikidata_id' => $datum->wikidata_id,
            'match_confidence' => $datum->match_confidence,
            'match_source' => $datum->match_source,
        ];
    }
}
