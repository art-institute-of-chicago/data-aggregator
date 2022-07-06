<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkAssetPivot extends BasePivot
{
    public $incrementing = true;

    protected $table = 'artwork_asset';

    protected $casts = [
        'preferred' => 'boolean',
    ];

    public function asset()
    {
        return $this->belongsTo('App\Models\Collections\Asset', 'asset_id');
    }

    public function artwork()
    {
        return $this->belongsTo('App\Models\Collections\Artwork');
    }
}
