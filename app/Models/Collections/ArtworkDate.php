<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;

class ArtworkDate extends CollectionsModel
{

    protected $casts = [
        'date_earliest' => 'datetime',
        'date_latest' => 'datetime',
        'preferred' => 'boolean',
    ];

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function qualifier()
    {

        return $this->belongsTo('App\Models\Collections\ArtworkDateQualifier', 'artwork_date_qualifier_citi_id');

    }

    public function getUpdatedAtColumn()
    {

        return 'updated_at';

    }

}
