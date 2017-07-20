<?php

namespace App\Models\Collections;

class Exhibition extends CollectionsModel
{

    public $incrementing = false;
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

}
