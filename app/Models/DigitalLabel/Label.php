<?php

namespace App\Models\DigitalLabel;

use App\Models\DigitalLabelModel;
use App\Models\Documentable;

/**
 * An individual interactive label in our galleries.
 */
class Label extends DigitalLabelModel
{

    use Documentable;

    protected $table = 'digital_labels';

    protected $casts = [
        'published' => 'boolean',
    ];

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_digital_label', 'digital_label_id');

    }

    public function artists()
    {

        return $this->belongsToMany('App\Models\Collections\Agent', 'artist_digital_label', 'digital_label_id');

    }

    public function exhibition()
    {

        return $this->belongsTo('App\Models\DigitalLabel\Exhibition', 'digital_label_exhibition_id');

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {
        return [
            [
                "name" => 'exhibition_id',
                "doc" => "Unique identifier of the collections exhibition this label is associated with",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->exhibition->exhibition_citi_id ?? null; },
            ],
            [
                "name" => 'type',
                "doc" => "The type of label this is in the gallery",
                "type" => "string",
                "value" => function() { return $this->type; },
            ],
            [
                "name" => 'copy_text',
                "doc" => "All the compiled text of this label",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->copy_text; },
            ],
            [
                "name" => 'image_url',
                "doc" => "URL to the main image of this label",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image_url; },
            ],
            [
                "name" => 'color',
                "doc" => "The main color associated with this label",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->exhibition->color ?? null; },
            ],
            [
                "name" => 'background_color',
                "doc" => "The background color associated with this label",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->exhibition->background_color ?? null; },
            ],
            [
                "name" => 'is_published',
                "doc" => "Whether the label is available to view",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->is_published && ($this->exhibition->is_published ?? true); },
            ],
            [
                "name" => 'source_created_at',
                "doc" => "Date the source record was created",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->source_created_at->toIso8601String(); },
            ],
            [
                "name" => 'source_modified_at',
                "doc" => "Date the source record was modified",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->source_modified_at->toIso8601String(); },
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

        return "593";

    }

}
