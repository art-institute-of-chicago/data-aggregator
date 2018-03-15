<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Tag-like classifications of artworks and other resources.
 */
class CategoryTerm extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'lake_uid';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function term()
    {
        return $this->belongsTo('App\Models\Collections\Term', 'lake_uid', 'lake_uid');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Collections\Category', 'lake_uid', 'lake_uid');
    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'term_id',
                "doc" => "If this record is a term, the unique identifier that can be used to find relationships with other resources.",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->term->citi_id ?? null; }
            ],
            [
                "name" => 'category_id',
                "doc" => "If this record is a category, the unique identifier that can be used to find relationships with other resources.",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->category->citi_id ?? null; }
            ],
            [
                "name" => 'type',
                "doc" => "For categories, a number representing the type of category. 1 is departmental, 2 is subject, 3 is theme, 5 is multimedia. For terms, a string indicating the type of term. Can be 'style', 'classification' or 'subject'.",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->type; }
            ],
        ];

    }


    protected function getMappingForIds()
    {

        $ret = parent::getMappingForIds();

        // Override the first (id) field
        $ret[0]['type'] = 'string';
        $ret[0]['elasticsearch']['type'] = 'keyword';

        return $ret;

    }


    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "PC-466";

    }


    /**
     * Ensure that the id is a valid LAKE UID.
     *
     * @param mixed $id
     * @return boolean
     */
    public static function validateId($id)
    {

        return \App\Models\Collections\Term::validateId($id);

    }

}
