<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Agent as AgentTransformer;
use App\Transformers\Outbound\Collections\Place as PlaceTransformer;
use App\Transformers\Outbound\CollectionsTransformer;

use App\Transformers\Outbound\Collections\Traits\HidesDefaultFields;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class AgentPlacePivot extends BaseTransformer
{

    use HidesDefaultFields;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'agent',
        'place',
        'qualifier',
    ];

    /**
     * Include artwork.
     *
     * @param  \App\Models\Collections\AgentPlacePivot  $pivot
     * @return \League\Fractal\Resource\Item
     */
    public function includeAgent($pivot)
    {
        return $this->item($pivot->agent, new AgentTransformer(), false);
    }

    /**
     * Include place.
     *
     * @param  \App\Models\Collections\AgentPlacePivot  $pivot
     * @return \League\Fractal\Resource\Item
     */
    public function includePlace($pivot)
    {
        return $this->item($pivot->place, new PlaceTransformer(), false);
    }

    /**
     * Include artwork place qualifier.
     *
     * @param  \App\Models\Collections\AgentPlacePivot  $pivot
     * @return \League\Fractal\Resource\Item
     */
    public function includeQualifier($pivot)
    {
        return $this->item($pivot->qualifier, new CollectionsTransformer(), false);
    }

    protected function getFields()
    {
        return [
            'is_preferred' => [
                'doc' => 'Whether this is the preferred place to represent this agent',
                'type' => 'boolean',
            ],

            // TODO: Refactor relationships:
            'artwork_title' => [
                'doc' => 'Name of the agent associated with this place',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->agent->title ?? null;
                },
            ],
            'artwork_id' => [
                'doc' => 'Unique identifier of the agent associated with this place',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->agent->citi_id ?? null;
                },
            ],
            'place_title' => [
                'doc' => 'Name of the place associated with this agent',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->place->title ?? null;
                },
            ],
            'place_id' => [
                'doc' => 'Unique identifier of the place associated with this agent',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->place->citi_id ?? null;
                },
            ],
            'qualifier_title' => [
                'doc' => 'Name of the qualifier indicating what happened to the agent here',
                'type' => 'string',
                'value' => function ($item) {
                    return $item->qualifier->title ?? null;
                },
            ],
            'qualifier_id' => [
                'doc' => 'Unique identifier of the qualifier indicating what happened to the agent here',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->qualifier->citi_id ?? null;
                },
            ],
        ];
    }
}
