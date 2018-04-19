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

    private const CLASSIFICATION = 1;
    private const MATERIAL = 2;
    private const TECHNIQUE = 3;
    private const STYLE = 4;
    private const SUBJECT = 5;

    protected $primaryKey = 'lake_uid';
    protected $keyType = 'string';

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

    /**
     * Scope a query to only include terms that are of type 'style'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStyle($query)
    {

        return $query->where('term_type_id', self::STYLE);

    }

    /**
     * Scope a query to only include terms that are of type 'classification'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClassification($query)
    {

        return $query->where('term_type_id', self::CLASSIFICATION);

    }

    /**
     * Scope a query to only include terms that are of type 'subject'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSubject($query)
    {

        return $query->where('term_type_id', self::SUBJECT);

    }

    /**
     * Scope a query to only include terms that are of type 'material'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMaterial($query)
    {

        return $query->where('term_type_id', self::MATERIAL);

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'term_type_id',
                "doc" => "The unique identifier of term type.",
                "type" => "string",
                "elasticsearch_type" => 'keyword',
                "value" => function() { return $this->term_type_id; },
            ],
        ];

    }


    protected function fillIdsFrom($source)
    {

        $this->lake_uid = $source->lake_uid;

        return $this;

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
