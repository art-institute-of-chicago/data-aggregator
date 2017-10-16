<?php

namespace App\Models\Collections;

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

    /**
     * Create a new instance of the given model.
     *
     * @param  array  $attributes
     * @param  bool  $exists
     * @return static
     */
    public function newInstance($attributes = [], $exists = false)
    {

        $model = parent::newInstance($attributes, $exists);
        $model->agentType()->associate(\App\Models\Collections\AgentType::where('title', 'Corporate Body')->first());
        return $model;

    }

    public function getAgentTypeAttribute()
    {

        App\Models\Collections\AgentType::where('title', 'Corporate Body')->first();

    }

    /**
     * The artworks that belong to the category.
     */
    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

    /**
     * For this resource, use this as the full documentation.
     *
     * @return string
     */
    public function docOnly()
    {

        $doc = "Venues are a subset of agents filtered by `agent_type` with values `Corporate Body`. ";
        $doc .= "The following endpoints are available with the same parameters and output as their corresponding `/agents` endpoints:\n\n";

        $doc .= "* `/venues`\n";
        $doc .= "* `/venues/{id}`\n";

        return $doc;
    }

}
