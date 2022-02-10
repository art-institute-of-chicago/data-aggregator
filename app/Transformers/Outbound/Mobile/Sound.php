<?php

namespace App\Transformers\Outbound\Mobile;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Sound extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'title' => [
                'doc' => 'Name of this mobile audio file – derived from the artwork and tour titles',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
                'value' => function ($item) {
                    $title = summation($item->artworks->pluck('title')->all());

                    if (!$title) {
                        $title = (strpos('intro', strtolower($item->title)) !== false) ? 'Intro' : $item->title;
                    }

                    $tourSuffix = summation(array_merge(
                        $item->introducedTours->pluck('title')->all() ?? [],
                        $item->stops->pluck('tour')->pluck('title')->all() ?? []
                    ));

                    if ($title && $tourSuffix) {
                        $title .= ' (' . $tourSuffix . ')';
                    }

                    return $title;
                },
            ],
            'web_url' => [
                'doc' => 'URL to the audio file',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'transcript' => [
                'doc' => 'Text transcription of the audio file',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
        ];
    }
}
