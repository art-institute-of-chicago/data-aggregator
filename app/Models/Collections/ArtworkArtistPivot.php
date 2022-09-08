<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkArtistPivot extends BasePivot
{
    public $incrementing = true;

    protected $table = 'artwork_artist';

    protected $casts = [
        'is_preferred' => 'boolean',
    ];

    public function artist()
    {
        return $this->belongsTo('App\Models\Collections\Agent', 'agent_id');
    }

    public function artwork()
    {
        return $this->belongsTo('App\Models\Collections\Artwork');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Collections\AgentRole', 'agent_role_id');
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
}
