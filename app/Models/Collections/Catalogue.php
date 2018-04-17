<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents a catalogue raisonne. A catalogue raisonné is a comprehensive, annotated listing of all the known artworks by an artist.
 */
class Catalogue extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';

    protected $dates = [
        'source_created_at',
        'source_modified_at',
        'source_indexed_at',
        'citi_created_at',
        'citi_modified_at',
    ];

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

}
