<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;

/**
 * Represents a catalogue raisonne. A catalogue raisonné is a comprehensive, annotated listing of all the known artworks by an artist.
 */
class Catalogue extends CollectionsModel
{

    protected $primaryKey = 'citi_id';

    public function artworks()
    {
        return $this->belongsToMany('App\Models\Collections\Artwork')->artworks();
    }

    public static function validateId( $id )
    {

        // By default, only allow numeric ids greater than 0
        return is_numeric($id);

    }
}
