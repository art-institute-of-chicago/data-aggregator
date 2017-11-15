<?php

namespace App\Models\Collections;

/**
 * A person who created an artwork. This is a type of Agent.
 */
class Artist extends Agent
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agents';

    public function newQuery($excludeDeleted = true)
    {

        return parent::newQuery()->where('is_artist', '=', TRUE);

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
        $model->agentType()->associate(\App\Models\Collections\AgentType::where('title', 'Individual')->first());
        $model->is_artist = TRUE;
        return $model;

    }

    public function getAgentTypeAttribute()
    {

        App\Models\Collections\AgentType::where('title', 'Individual')->first();

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

        $doc = "Artists are a subset of agents filtered by `is_artist` with values `TRUE`. ";
        $doc .= "The following endpoints are available with the same parameters and output as their corresponding `/agents` endpoints:\n\n";

        $doc .= "* `/artists`\n";
        $doc .= "* `/artists/{id}`\n";

        return $doc;

    }

}
