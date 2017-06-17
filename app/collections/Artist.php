<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Artist extends Agent
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agents';
    
    public function getAgentTypeAttribute()
    {

        App\Collections\AgentType::where('title', 'Artist')->first();
        
    }

}
