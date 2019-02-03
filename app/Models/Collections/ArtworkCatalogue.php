<?php

namespace App\Models\Collections;

use App\Models\TransformableRefactor;

use App\Models\AbstractPivot as BasePivot;

class ArtworkCatalogue extends BasePivot
{

    use TransformableRefactor;

    protected static $source = 'Collections';

    protected $primaryKey = 'citi_id';

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'source_created_at' => 'datetime',
        'source_modified_at' => 'datetime',
        'source_indexed_at' => 'datetime',
        'citi_created_at' => 'datetime',
        'citi_modified_at' => 'datetime',
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
