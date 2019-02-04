<?php

namespace App\Transformers\Outbound\Mobile;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Sound extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'link' => [
                'doc' => 'URL to the audio file',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'transcript' => [
                'doc' => 'Text transcription of the audio file',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'type' => 'text',
                ],
            ],
        ];
    }

}
