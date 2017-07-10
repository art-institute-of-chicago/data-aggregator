<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class CollectionsModel extends Model
{

    public static function findOrCreate($id)
    {

        return static::firstOrCreate([(new static)->getKeyName() => $id], factory(static::class)->make()->getAttributes());

    }

    public static function classFor($endpoint)
    {

        switch ($endpoint) {
        case 'artists':
            return \App\Collections\Agent::class;
            break;
        case 'departments':
            return \App\Collections\Department::class;
            break;
        case 'artworks':
            return \App\Collections\Artwork::class;
            break;
        }

    }

}
