<?php

namespace App\Transformers\Inbound\Collections;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

class Exhibition extends CollectionsTransformer
{

    protected function getExtraFields( Datum $datum )
    {

        return [
            'type' => $datum->exhibition_type,
            'status' => $datum->exhibition_status,
            'place_citi_id' => $datum->gallery_id,
            'place_display' => $datum->gallery,
            'date_start' => $datum->date('start_date'),
            'date_end' => $datum->date('end_date'),
            'date_aic_start' => $datum->date('aic_start_date'),
            'date_aic_end' => $datum->date('aic_end_date'),
            'source_indexed_at' => $datum->date('indexed_at'),
        ];

    }

    protected function getSync( Datum $datum )
    {

        return [
            'artworks' => $datum->all('artwork_ids'),
            'assets' => $this->getSyncAssets( $datum ),
            'venues' => $this->getSyncVenues( $datum ),
        ];

    }

    private function getSyncAssets( Datum $datum )
    {

        // TODO: This logic is shared w/ artworks - consider abstracting it elsewhere?
        $assets = collect( $datum->alt_image_guids ?? [] )->map( function( $asset ) {
            return [
                $asset => [
                    'preferred' => false,
                    'is_doc' => false,
                ]
            ];
        });

        if ($datum->image_guid)
        {

            $assets->push([
                $datum->image_guid => [
                    'preferred' => true,
                    'is_doc' => false,
                ]
            ]);

        }

        // TODO: Shared logic w/ exhibitions - abstract?
        $documents = collect( $datum->document_ids ?? [] )->map( function( $document ) {
            return [
                $document => [
                    'preferred' => false,
                    'is_doc' => true,
                ]
            ];
        });

        $assets = $assets->concat( $documents );

        // This only works for string keys!
        $assets = $assets->collapse();

        return $assets;

    }

    private function getSyncVenues( Datum $datum )
    {

        return $this->getSyncPivots( $datum, 'exhibition_agents', 'agent_id', function( $pivot ) {

            // Needed for the `date` call
            $pivot = new Datum( $pivot );

            // TODO: Consider adding that to AbstractTransformer?

            return [
                $pivot->agent_id => [
                    'citi_id' => $pivot->citi_id, // TODO: Make this incremental?
                    'date_start' => $pivot->date('start_date'),
                    'date_end' => $pivot->date('end_date'),
                    'is_host' => $pivot->is_host,
                    'is_organizer' => $pivot->is_organizer,
                ]
            ];

        });

    }

}
