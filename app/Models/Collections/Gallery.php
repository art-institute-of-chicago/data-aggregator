<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\SolrSearchable;

class Gallery extends CollectionsModel
{

    use SolrSearchable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'closed' => $source->closed,
            'number' => $source->number,
            'floor' => $source->floor,
            'latitude' => $source->latitude,
            'longitude' => $source->longitude,
        ];

    }


    /**
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return  [
            'is_closed' => (bool) $this->closed,
            'number' => $this->number,
            'floor' => $this->floor,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            // @TODO: This causes java.lang.NullPointerException
            // 'latlon' => $this->latitude .',' .$this->longitude,
            'category_ids' => $this->categories->pluck('lake_guid')->all(),
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

            'category_titles' => $this->categories->pluck('title')->all(),

        ];

    }

}
