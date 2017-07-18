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
        $model->agentType()->associate(\App\Collections\AgentType::where('title', 'Corporate Body')->first());
        return $model;

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
