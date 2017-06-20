<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class CopyrightRepresentative extends Agent
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agents';

    public function newQuery($excludeDeleted = true)
    {

        return parent::newQuery()->whereHas('agentType', function ($query) { $query->where('title', '=', 'Copyright Representative'); });

    }
    
    public function getAgentTypeAttribute()
    {

        App\Collections\AgentType::where('title', 'Copyright Representative')->first();
        
    }

    /**
     * The artworks that belong to the category.
     */
    public function artworks()
    {

        return $this->belongsToMany('App\Collection\Artwork');

    }


}
