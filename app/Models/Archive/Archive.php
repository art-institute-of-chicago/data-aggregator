<?php

namespace App\Models\Archive;

use App\Models\BaseModel;
use App\Models\ElasticSearchable;

class Archive extends BaseModel
{
    use ElasticSearchable;
    protected $hasSourceDates = false;

    protected $casts = [
        'lccn' => 'array',
        'metadata' => 'array',
    ];

    public function agents()
    {
        return $this->belongsToMany(
            'App\Models\Collections\Agent',
            'agent_archive',
            'archive_id',
            'agent_citi_id'
        );
    }
}
