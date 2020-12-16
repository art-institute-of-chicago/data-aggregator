<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

class Asset extends CollectionsTransformer
{

    protected function getIds(Datum $datum)
    {
        return  [
            'lake_guid' => strval($datum->id),
            'netx_uuid' => \App\Models\Collections\Asset::getHashedId($datum->id),
        ];
    }

    // Unfortunately, NetX does not provide this data:
    // protected function getDates(Datum $datum)
    // {
    //     $dates = parent::getDates($datum);

    //     return array_merge($dates, [
    //         'content_modified_at' => $datum->date('content_modified_at'),
    //     ]);
    // }

    protected function getSync(Datum $datum, $test = false)
    {
        return env('IMPORT_ASSET_RELATIONSHIPS_FROM_CITI', false) ? [] : [
            'imagedArtworks' => $this->getSyncAssetOf($datum, 'rep_of_artworks'),
            'imagedExhibitions' => $this->getSyncAssetOf($datum, 'rep_of_exhibitions'),
            'documentedArtworks' => $this->getSyncAssetOf($datum, 'doc_of_artworks'),
            'documentedExhibitions' => $this->getSyncAssetOf($datum, 'doc_of_exhibitions'),
        ];
    }

    private function getSyncAssetOf(Datum $datum, string $pivot_field)
    {
        return $this->getSyncPivots($datum, $pivot_field, 'related_id', function ($pivot) {
            return [
                $pivot->related_id => [
                    'preferred' => $pivot->is_preferred,
                    'is_doc' => $pivot->is_doc,
                ],
            ];
        });
    }
}
