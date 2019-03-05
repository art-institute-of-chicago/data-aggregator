<?php

namespace App\Models\Collections;

use App\Models\AbstractPivot as BasePivot;

class ArtworkCatalogue extends BasePivot
{

    protected static $source = 'Collections';

    protected $primaryKey = 'citi_id';

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'source_modified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

    public function catalogue()
    {

        return $this->belongsTo('App\Models\Collections\Catalogue');

    }

    public function getUpdatedAtColumn()
    {

        return 'updated_at';

    }

}
