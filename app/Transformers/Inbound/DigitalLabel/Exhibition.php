<?php

namespace App\Transformers\Inbound\DigitalLabel;

use Carbon\Carbon;

use App\Transformers\Datum;
use App\Transformers\Inbound\DigitalLabelTransformer;

class Exhibition extends DigitalLabelTransformer
{

    protected function getIds( Datum $datum )
    {

        return [
            'id' => $datum->objectId,
        ];

    }

    protected function getExtraFields( Datum $datum )
    {

        return [

            'exhibition_citi_id' => $this->getExhibitionCitiId($datum->objectId),
            'color' => $datum->colorCode,
            'background_color' => $datum->backgroundColorCode,
            'is_published' => !$datum->archived,

        ];

    }

    private function getExhibitionCitiId( $objectId )
    {

        static $mapping = [
            '114' => 2353,
            '131' => 2681,
            '133' => 2345,
            '148' => 2076,
            '153' => 2954,
            '154' => 2681,
            '155' => 2756,
            '161' => 2962,
            '163' => 2522,
            '166' => 2823,
        ];

        return $mapping[$objectId] ?? null;

    }

}
