<?php

namespace App\Collections;

class Exhibition extends CollectionsModel
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function artworks()
    {

        return $this->belongsToMany('App\Collections\Artwork');

    }

    public function venues()
    {

        return $this->belongsToMany('App\Collections\CorporateBody', 'agent_exhibition', 'exhibition_citi_id', 'agent_citi_id');

    }

    public function department()
    {

        return $this->belongsTo('App\Collections\Department');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Collections\Gallery');

    }

    public function seedArtworks()
    {

        $artworkIds = \App\Collections\Artwork::all()->pluck('citi_id')->all();

        for ($i = 0; $i < rand(2,8); $i++) {

            $artworkId = $artworkIds[array_rand($artworkIds)];

            $exhibition->artworks()->attach($artworkId);

        }

        return $this;

    }

    public function seedVenues()
    {

        $agentIds = \App\Collections\CorporateBody::all()->pluck('citi_id')->all();

        for ($i = 0; $i < rand(1,3); $i++) {

            $agentId = $agentIds[array_rand($agentIds)];

            $exhibition->venues()->attach($agentId);

        }

        return $this;

    }

}
