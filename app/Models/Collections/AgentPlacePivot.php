<?php

namespace App\Models\Collections;

use App\Models\HasRelationshipArray;

use App\Models\AbstractPivot as BasePivot;

class AgentPlacePivot extends BasePivot
{

    use HasRelationshipArray;

    public $incrementing = true;

    protected $table = 'agent_place';

    protected $casts = [
        'is_preferred' => 'boolean',
    ];

    private function getRelationships()
    {
        return [
            'agent' => [
                'description' => '',
                'method' => function() {
                    return $this->belongsTo('App\Models\Collections\Agent');
                },
            ],
            'place' => [
                'description' => '',
                'method' => function() {
                    return $this->belongsTo('App\Models\Collections\Place');
                },
            ],
            'qualifier' => [
                'description' => '',
                'method' => function() {
                    return $this->belongsTo('App\Models\Collections\AgentPlaceQualifier', 'agent_place_qualifier_citi_id');
                },
            ],
        ];
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
}
