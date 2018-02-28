<?php

namespace App\Models\Library;

use App\Models\LibraryModel as BaseModel;

/**
 * A Library of Congress term.
 */
class Term extends BaseModel
{

    protected $hasSourceDates = false;

    protected $table = 'library_terms';

    protected $keyType = 'string';

    public function creatorOf()
    {

        return $this->belongsToMany('App\Models\Library\Material', 'library_material_creator', 'term_id', 'material_id');

    }

    public function subjectOf()
    {

        return $this->belongsToMany('App\Models\Library\Material', 'library_material_creator', 'term_id', 'material_id');

    }

    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'uri',
                "doc" => "Full Library of Congress URI for identification",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->uri; },
            ],
        ];

    }

    /**
     * Whether this resource has a `/search` endpoint
     *
     * @return boolean
     */
    public function hasSearchEndpoint()
    {

        return false;

    }

    /**
     * Ensure that the id is a valid Library of Congress control number (LCCN).
     *
     * @param string $id
     * @return boolean
     */
    public static function validateId( $id )
    {

        return preg_match('/[a-z]+[0-9]+/', $id);

    }

}
