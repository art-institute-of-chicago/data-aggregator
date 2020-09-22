<?php

namespace App\Models\Collections;

use App\Models\HasRelationshipArray;

use App\Models\AbstractPivot as BasePivot;

class ArtworkArtistPivot extends BasePivot
{
    use HasRelationshipArray;

    public $incrementing = true;

    protected $table = 'artwork_artist';

    protected $casts = [
        'preferred' => 'boolean',
    ];

    private function getRelationships()
    {
        return [
            'artist' => [
                'description' => '',
                'method' => function() {
                    return $this->belongsTo('App\Models\Collections\Agent', 'agent_citi_id');
                },
            ],
            'artwork' => [
                'description' => '',
                'method' => function() {
                    return $this->belongsTo('App\Models\Collections\Artwork');
                },
            ],
            'role' => [
                'description' => '',
                'method' => function() {
                    return $this->belongsTo('App\Models\Collections\AgentRole', 'agent_role_citi_id');
                },
            ],
        ];
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
}
