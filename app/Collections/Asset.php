<?php

namespace App\Collections;

class Asset extends CollectionsModel
{

    public $incrementing = false;
    protected $primaryKey = 'lake_guid';
    protected $keyType = 'string';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at'];
    
    public function artist()
    {

        return $this->belongsTo('App\Collections\Artist', 'agent_citi_id');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Collections\Category');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'description' => $source->description,
            'content' => $source->content,
            'published' => $source->published,
        ];

    }

    public function attachFrom($source)
    {

        if ($source->artist_id)
        {

            $artist = Artist::findOrCreate($source->artist_id);
            $this->artist()->associate($artist);

        }

        return $this;

    }

}
