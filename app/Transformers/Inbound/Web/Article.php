<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\AbstractTransformer;

class Article extends AbstractTransformer
{

    use HasBlocks { getExtraFields as getBlockFields; }

    protected function getTitle( Datum $datum )
    {

        return [
            'title' => $datum->slug,
        ];

    }

    protected function getExtraFields( Datum $datum )
    {

        return array_merge( $this->getBlockFields( $datum ), [
            'date' => $datum->date('date'),
        ]);

    }

}
