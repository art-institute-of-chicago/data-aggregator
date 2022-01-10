<?php

namespace App\Transformers\Outbound\Mobile;

use App\Transformers\Outbound\Mobile\TourStop as TourStopTransformer;

use App\Transformers\Outbound\HasSuggestFields;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Tour extends BaseTransformer
{

    use HasSuggestFields {
        getSuggestFields as traitGetSuggestFields;
    }

    protected $availableIncludes = ['tour_stops'];

    public function includeTourStops($tour)
    {
        return $this->collection($tour->tourStops, new TourStopTransformer(), false);
    }

    protected function getFields()
    {
        return [
            'image' => [
                'doc' => 'The main image for the tour',
                'type' => 'url',
                'elasticsearch' => 'keyword',
            ],
            'description' => [
                'doc' => 'Explanation of what the tour is',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'intro' => [
                'doc' => 'Text introducing the tour',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
                'value' => function ($item) {
                    return $item->intro_text;
                },
            ],
            'weight' => [
                'doc' => 'Number representing this tour\'s sort order',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'intro_link' => [
                'doc' => 'Link to the audio file of the introduction',
                'type' => 'url',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->intro->link ?? null;
                },
            ],
            'intro_transcript' => [
                'doc' => 'Transcript of the introduction audio to the tour',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
                'value' => function ($item) {
                    return $item->intro->transcript ?? null;
                },
            ],
            'artwork_titles' => [
                'doc' => 'Names of the artworks featured in this tour\'s tour stops',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                    'mapping' => $this->getDefaultStringMapping(true),
                ],
                'value' => function ($item) {
                    return $item->tourStops->pluck('artwork')->pluck('artwork')->pluck('title')->filter()->values();
                },
            ],
            'artist_titles' => [
                'doc' => 'Names of the artists of the artworks featured in this tour\'s tour stops',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,
                    'mapping' => $this->getDefaultStringMapping(true),
                ],
                'value' => function ($item) {
                    return $item->tourStops->pluck('artwork')->pluck('artwork')->pluck('artists')->collapse()->pluck('title');
                },
            ],
        ];
    }

    /**
     * Tours should always contribute to autosuggest, regardless of boost.
     */
    protected function getSuggestFields()
    {
        $suggestFields = $this->traitGetSuggestFields();

        $suggestFields['suggest_autocomplete_boosted']['filter'] = function ($item) {
            return isset($item->title);
        };

        return $suggestFields;
    }
}
