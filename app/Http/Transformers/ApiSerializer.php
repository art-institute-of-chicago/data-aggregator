<?php

namespace App\Http\Transformers;

use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Resource\ResourceInterface;


class ApiSerializer extends DataArraySerializer
{

    public function collection($resourceKey, array $data)
    {

        if ($resourceKey === false) {
            return $data;
        }
        return array($resourceKey ?: 'data' => $data);

    }

    public function item($resourceKey, array $data)
    {

        if ($resourceKey === false) {
            return $data;
        }
        return array($resourceKey ?: 'data' => $data);

    }

}