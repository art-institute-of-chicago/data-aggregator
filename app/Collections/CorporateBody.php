<?php

namespace App\Collections;

class CorporateBody extends Agent
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agents';

    public function newQuery($excludeDeleted = true)
    {

        return parent::newQuery()->whereHas('agentType', function ($query) { $query->where('title', '=', 'Corporate Body'); });

    }
    
    public function getAgentTypeAttribute()
    {

        App\Collections\AgentType::where('title', 'Corporate Body')->first();
        
    }

    /**
     * The artworks that belong to the category.
     */
    public function artworks()
    {

        return $this->belongsToMany('App\Collection\Artwork');

    }


}
