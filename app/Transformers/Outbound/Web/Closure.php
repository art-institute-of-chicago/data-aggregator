<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Closure extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'date_start' => [
                'doc' => 'The date the closure begins',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('date_start'),
            ],
            'date_end' => [
                'doc' => 'The date the closure ends',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('date_end'),
            ],
            'closure_copy' => [
                'doc' => 'Description of the closure',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'type' => [
                'doc' => 'Number indicating the type of closure',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
        ];
    }

}
