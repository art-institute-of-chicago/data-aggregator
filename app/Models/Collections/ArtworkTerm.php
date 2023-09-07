<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkTerm extends BasePivot
{
    public $incrementing = true;

    public function term()
    {
        return $this->belongsTo('App\Models\Collections\Term');
    }

    public function artwork()
    {
        return $this->belongsTo('App\Models\Collections\Artwork');
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
}
