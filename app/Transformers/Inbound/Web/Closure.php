<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Closure extends WebTransformer
{

    protected function getTitle(Datum $datum)
    {
        // TODO: Make title nullable? Use date range as title?
        // There's no title in the source system :/

        return [
            'title' => 'Lorem ipsum.',
        ];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'date_start' => $datum->date('date_start'),
            'date_end' => $datum->date('date_end'),
        ];
    }

}
