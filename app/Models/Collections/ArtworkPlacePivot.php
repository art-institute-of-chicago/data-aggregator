<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkPlacePivot extends BasePivot
{
    public $incrementing = true;

    protected $table = 'artwork_place';

    protected $casts = [
        'is_preferred' => 'boolean',
    ];

    public function artwork()
    {
        return $this->belongsTo('App\Models\Collections\Artwork');
    }

    public function place()
    {
        return $this->belongsTo('App\Models\Collections\Place');
    }

    public function qualifier()
    {
        return $this->belongsTo('App\Models\Collections\ArtworkPlaceQualifier', 'artwork_place_qualifier_id');
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
}
