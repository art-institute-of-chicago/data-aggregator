<?php

namespace App\Models\Library;

use App\Models\LibraryModel as BaseModel;

/**
 * A library material, such as a book, journal, or video.
 */
class Material extends BaseModel
{

    protected $table = 'library_materials';

    public function creators()
    {

        return $this->belongsToMany('App\Models\Library\Term', 'library_material_creator', 'material_id', 'term_id');

    }

    public function subjects()
    {

        return $this->belongsToMany('App\Models\Library\Term', 'library_material_subject', 'material_id', 'term_id');

    }

    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'date',
                "doc" => "Publication year of this library material",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->date; },
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
     * Ensure that the id is a valid Primo doc id.
     *
     * @param string $id
     * @return boolean
     */
    public static function validateId( $id )
    {

        $length = strlen( env('PRIMO_API_SOURCE') );

        return substr( $id, 0, $length ) == env('PRIMO_API_SOURCE') && is_numeric( substr( $id, $length ) );

    }

}
