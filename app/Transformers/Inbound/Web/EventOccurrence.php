<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class EventOccurrence extends WebTransformer
{

    protected $passthrough = true;

    protected function getIds( Datum $datum )
    {

        return [
            // 'id' => $this->getCantorId( $datum ),
            'event_id' => $datum->id,
        ];

    }

    protected function getExtraFields( Datum $datum )
    {

        return [
            'event_id' => $datum->id,
            'start_at' => $datum->datetime('start_at'),
            'end_at' => $datum->datetime('end_at'),
            // TODO: Fix ellipsis issue upstream [WEB-507]
            'image_caption' => $datum->image_caption ? html_entity_decode( $datum->image_caption ) : null,
        ];

    }

    /**
     * Just an experiment for setting ids deterministically.
     * To use this, set this in the EventOccurrence model:
     *
     *     public $incrementing = false;
     *
     * Also add this to the relevant migration:
     *
     *     $table->bigInteger('id')->primary();
     *
     * Not using this because it runs into PHP int-bound issues.
     */
    private function getCantorId( $datum )
    {
        $timestamp = $datum->date('start_at'); // max one occurrence of a given master event per second
        $timestamp = $timestamp / 60; // max one occurrence per minute
        $timestamp = $timestamp / 15; // max one occurrence every fifteen minutes

        $timestamp = floor( $timestamp ); // this is still a float here. int bounds?

        return cantorPair( $datum->id, $timestamp );
    }

}
