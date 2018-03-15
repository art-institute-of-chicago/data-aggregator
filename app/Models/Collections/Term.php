<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents a term/tag on an artwork. In the API, this includes styles, classifications and subjects.
 * Terms are meant to be more specific than publish categories, and is a taxonomy taken from Getty AAT.
 */
class Term extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'lake_uid';
    protected $keyType = 'string';

    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

    /**
     * Scope a query to only include terms that are of type 'style'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStyle($query)
    {

        return $query->where('type', 'style');

    }

    /**
     * Scope a query to only include terms that are of type 'classification'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClassification($query)
    {

        return $query->where('type', 'classification');

    }

    /**
     * Scope a query to only include terms that are of type 'subject'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSubject($query)
    {

        return $query->where('type', 'subject');

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'type',
                "doc" => "The type of term. Can be 'style', 'classification' or 'subject'.",
                "type" => "string",
                "elasticsearch_type" => 'text',
                "value" => function() { return $this->type; },
            ],
        ];

    }


    /**
     * Ensure that the id is a valid LAKE UID.
     *
     * @param mixed $id
     * @return boolean
     */
    public static function validateId($id)
    {

        $uid = '/^[A-Z]{2}-[0-9]+$/i';

        return preg_match($uid, $id);

    }

}
