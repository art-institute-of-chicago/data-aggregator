<?php

namespace App\Http\Transformers;

use App\Collections\Artwork;
use App\Collections\Agent;
use League\Fractal\TransformerAbstract;

class ArtworkTransformer extends TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['creator']; // also 'department'

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = []; // 'creator' or 'department'

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Artwork  $item
     * @return array
     */
    public function transform(Artwork $item)
    {

        return [
            'id' => $item->citi_id,
            'title' => $item->title,
            'main_reference_number' => $item->main_id,
            'date_start' => $item->date_start,
            'date_end' => $item->date_end,
            'date_display' => $item->date_display,
            'agent_id' => $item->agent_citi_id,
            'agent_display' => $item->agent_display,
            'department' => $item->department()->getResults() ? $item->department()->getResults()->title : '',
            'department_id' => $item->department_citi_id,
            'dimensions' => $item->dimensions,
            'medium' => $item->medium_display,
            'inscriptions' => $item->inscriptions,
            'object_type' => $item->objectType()->getResults() ? $item->objectType()->getResults()->title : '',
            'object_type_id' => $item->object_type_citi_id,
            'credit_line' => $item->credit_line,
            'publication_history' => $item->publications,
            'exhibition_history' => $item->exhibitions,
            'provenance_text' => $item->provenance,
            // Doing it this way so we don't get an extra 'data' block
            'dates' => $item->dates()->getResults()->transform(function ($item, $key) {
                return [
                    'date' => $item->date->toDateString(),
                    'qualifier' => $item->qualifier,
                    'preferred' => (bool) $item->preferred,
                ];
            }),
            'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
            'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
            'last_updated' => $item->updated_at->toDateTimeString(),
        ];
    }

    /**
     * Include creator.
     *
     * @param  \App\Collections\Artwork  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeCreator(Artwork $artwork)
    {
        return $this->item(Agent::where('lake_uid', '=', $artwork->creator_lake_uid)->first(), new AgentTransformer);
    }

}