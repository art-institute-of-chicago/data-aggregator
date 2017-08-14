<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

class Exhibition extends CollectionsModel
{

    use ElasticSearchable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

    public function venues()
    {

        return $this->belongsToMany('App\Models\Collections\CorporateBody', 'agent_exhibition', 'exhibition_citi_id', 'agent_citi_id');

    }

    public function department()
    {

        return $this->belongsTo('App\Models\Collections\Department');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Models\Collections\Gallery');

    }

    public function seedArtworks()
    {

        $artworkIds = \App\Models\Collections\Artwork::all()->pluck('citi_id')->all();

        for ($i = 0; $i < rand(2,8); $i++) {

            $artworkId = $artworkIds[array_rand($artworkIds)];

            $this->artworks()->attach($artworkId);

        }

        return $this;

    }

    public function seedVenues()
    {

        $agentIds = \App\Models\Collections\CorporateBody::all()->pluck('citi_id')->all();

        for ($i = 0; $i < rand(1,3); $i++) {

            $agentId = $agentIds[array_rand($agentIds)];

            $this->venues()->attach($agentId);

        }

        return $this;

    }


    /**
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return [
            'description' => $this->description,
            'type' => $this->type,
            'department' => $this->department()->getResults() ? $this->department()->getResults()->title : '',
            'department_id' => $this->department_citi_id,
            'gallery' => $this->gallery()->getResults() ? $this->gallery()->getResults()->title : '',
            'gallery_id' => $this->gallery_citi_id,
            'dates' => $this->exhibition_dates,
            'is_active' => (bool) $this->active,
            'artwork_ids' => $this->artworks->pluck('citi_id')->all(),
            'venue_ids' => $this->venues->pluck('citi_id')->all(),
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            'artwork_titles' => $this->artworks->pluck('title')->all(),
            'venue_titles' => $this->venues->pluck('title')->all(),

        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'type' => [
                    'type' => 'keyword',
                ],
                'department' => [
                    'type' => 'text',
                ],
                'department_id' => [
                    'type' => 'integer',
                ],
                'gallery' => [
                    'type' => 'text',
                ],
                'gallery_id' => [
                    'type' => 'integer',
                ],
                'dates' => [
                    'type' => 'text',
                ],
                'is_active' => [
                    'type' => 'boolean',
                ],
                'artwork_id' => [
                    'type' => 'integer',
                ],
                'artwork_ids' => [
                    'type' => 'integer',
                ],
                'artwork_titles' => [
                    'type' => 'text',
                ],
                'venue_ids' => [
                    'type' => 'integer',
                ],
                'venue_titles' => [
                    'type' => 'text',
                ],
            ];

    }

}
