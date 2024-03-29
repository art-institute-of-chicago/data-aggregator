<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkImagePivot extends BasePivot
{
    public $incrementing = true;

    protected $table = 'artwork_asset';

    protected $casts = [
        'is_preferred' => 'boolean',
    ];

    public function image()
    {
        return $this->belongsTo('App\Models\Collections\Image', 'asset_id')
            ->where('is_doc', '=', false)
            ->where('type', '=', 'image');
    }

    public function artwork()
    {
        return $this->belongsTo('App\Models\Collections\Artwork');
    }
}
