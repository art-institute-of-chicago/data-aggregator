<?php

namespace App\Models\Library;

use App\Models\LibraryModel as BaseModel;

/**
 * A library material, such as a book, journal, or video.
 */
class Material extends BaseModel
{

    protected $hasSourceDates = false;

    protected $table = 'library_materials';

    public function creators()
    {

        return $this->belongsToMany('App\Models\Library\Term', 'library_material_creator', 'material_id', 'term_id');

    }

    public function subjects()
    {

        return $this->belongsToMany('App\Models\Library\Term', 'library_material_subject', 'material_id', 'term_id');

    }

    public function attachFrom($source)
    {

        $creator_ids = collect( $source->creators )->pluck('id');
        $subject_ids = collect( $source->subjects )->pluck('id');

        $this->creators()->sync( $creator_ids, false );
        $this->subjects()->sync( $subject_ids, false );

        return $this;

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

}
