<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents a chapter of publication.
 */
class Section extends DscModel
{

    use ElasticSearchable;
    use Documentable;

    protected $fakeIdsStartAt = 90000000000;

    protected $hasSourceDates = false;

    public function publication()
    {

        return $this->belongsTo('App\Models\Dsc\Publication');

    }

    public function parent()
    {

        return $this->belongsTo('App\Models\Dsc\Section', 'parent_id');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork', 'artwork_citi_id');

    }


    public function getFillFieldsFrom($source)
    {

        return [
            'web_url' => $source->web_url,
            'accession' => $source->accession,
            'revision' => $source->revision,
            'source_id' => $source->source_id,
            'weight' => $source->weight,
            'parent_id' => $source->parent_id,
            'publication_dsc_id' => $source->publication_id,
            'artwork_citi_id' => $source->citi_id ?? null,
            'content' => $source->content,
        ];

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'web_url',
                "doc" => "URL to the section",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'accession',
                "doc" => "An accession number parsed from the title or tombstone",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->accession; },
            ],
            [
                "name" => 'revision',
                "doc" => "Version identifier as provided by Drupal",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->revision; },
            ],
            [
                "name" => 'source_id',
                "doc" => "Drupal node id, unique only within the site of this publication",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->source_id; },
            ],
            [
                "name" => 'weight',
                "doc" => "Number representing this section's sort order",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->weight; },
            ],
            [
                "name" => 'parent_id',
                "doc" => "Uniquer identifier of the parent section",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->parent ? $this->parent->dsc_id : null; },
            ],
            [
                "name" => 'publication',
                "doc" => "Name of the publication this section belongs to",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->publication ? $this->publication->title : ''; },
            ],
            [
                "name" => 'publication_id',
                "doc" => "Unique identifier of the publication this section belongs to",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->publication ? $this->publication->dsc_id : null; },
            ],
            [
                "name" => 'artwork_id',
                "doc" => "Unique identifier of the artwork with which this section is associated",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artwork ? $this->artwork->citi_id : null; },
            ],
            [
                "name" => 'content',
                "doc" => "Content of this section in plaintext",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->content; },
            ],

        ];

    }


    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "3014259";

    }

}
