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

}
