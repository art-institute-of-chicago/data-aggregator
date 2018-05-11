<?php

namespace App\Transformers\Inbound;

use App\Transformers\Datum;

class CollectionsTransformer extends AbstractTransformer
{

    protected function getIds( Datum $datum )
    {

        return  [
            'citi_id' => $datum->citi_id,
            'lake_uid' => $datum->lake_uid,
            'lake_guid' => $datum->lake_guid,
        ];

    }

    protected function getDates( Datum $datum )
    {

        $dates = parent::getDates( $datum );

        return array_merge( $dates, [
            'source_indexed_at' => $datum->date('indexed_at'),
            'citi_created_at' => $datum->date('citi_created_at'),
            'citi_modified_at' => $datum->date('citi_modified_at'),
        ]);

    }

}
