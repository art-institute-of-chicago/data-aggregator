<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class AgentPlacePivot extends BasePivot
{

    public $incrementing = true;

    protected $table = 'agent_place';

    protected $casts = [
        'is_preferred' => 'boolean',
    ];

    public function agent()
    {
        return $this->belongsTo('App\Models\Collections\Agent');
    }

    public function place()
    {
        return $this->belongsTo('App\Models\Collections\Place');
    }

    public function qualifier()
    {
        return $this->belongsTo('App\Models\Collections\AgentPlaceQualifier', 'agent_place_qualifier_citi_id');
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }

}
