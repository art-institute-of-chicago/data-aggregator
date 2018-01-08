<?php

namespace App\Models\Archive;

use App\Models\BaseModel;
use App\Models\Fillable;
use App\Models\Documentable;

/**
 * An image from the archives.
 */
class ArchivalImage extends BaseModel
{

    use Fillable;
    use Documentable;

    protected $dates = ['source_created_at', 'source_modified_at'];

    protected $casts = ['subject_terms' => 'array'];

    protected static $source = 'Archive';

    protected $primaryKey = 'id';

    protected $fakeIdsStartAt = 999000;

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'alternate_title',
                "doc" => "Alternate name of this image",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->alternate_title; },
            ],
            [
                "name" => 'web_url',
                "doc" => "URL to this image on the archives website",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->web_url; },
            ],
            [
                "name" => 'collection',
                "doc" => "Name of the collection this image is a part of",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->collection; },
            ],
            [
                "name" => 'archive',
                "doc" => "Name of the archive within this collection this image is a part of",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->archive; },
            ],
            [
                "name" => 'format',
                "doc" => "Physical format of the photograph",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->format; },
            ],
            [
                "name" => 'file_format',
                "doc" => "Format of the digital file",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->file_format; },
            ],
            [
                "name" => 'file_size',
                "doc" => "Number representing the size of the file in bytes",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->file_size; },
            ],
            [
                "name" => 'pixel_dimensions',
                "doc" => "Dimensions of the digital image",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->pixel_dimensions; },
            ],
            [
                "name" => 'color',
                "doc" => "Color type. Values include Color, B&W and Toned",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->color; },
            ],
            [
                "name" => 'physical_notes',
                "doc" => "Notes about the photograph",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->physical_notes; },
            ],
            [
                "name" => 'date',
                "doc" => "Date of photograph",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->date; },
            ],
            [
                "name" => 'date_object',
                "doc" => "Date the subject of the photograph was designed or built",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->date_object; },
            ],
            [
                "name" => 'date_view',
                "doc" => "",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->date_view; },
            ],
            [
                "name" => 'creator',
                "doc" => "Name of the architect, designer or creator",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->creator; },
            ],
            [
                "name" => 'additional_creator',
                "doc" => "Name of an additional architect, designer or creator",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->additional_creator; },
            ],
            [
                "name" => 'photographer',
                "doc" => "Name of person who took the photograph",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->photographer; },
            ],
            [
                "name" => 'main_id',
                "doc" => "Unique identifier used by the Archives for this image",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->main_id; },
            ],
            [
                "name" => 'legacy_image_id',
                "doc" => "Unique identifier used by Imaging for this image. Most of the these numbers of using their legacy ID schema.",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->legacy_image_id; },
            ],
            [
                "name" => 'subject_terms',
                "doc" => "Array of subject terms this image is tagged with",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->subject_terms; },
            ],
            [
                "name" => 'view',
                "doc" => "View of the object in the image",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->view; },
            ],
            [
                "name" => 'image_notes',
                "doc" => "Image description",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->image_notes; },
            ],
            [
                "name" => 'file_name',
                "doc" => "Name of the digital image file",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->file_name; },
            ],
            [
                "name" => 'source_created_at',
                "doc" => "Date the source record was created",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->source_created_at; },
            ],
            [
                "name" => 'source_modified_at',
                "doc" => "Date the source record was modified",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->source_modified_at; },
            ],
        ];

    }


    /**
     * Define functionality to import subject_terms
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillArraysAndObjectsFrom($source)
    {

        $fill = [];

        $fill['subject_terms'] = $source->subject_terms;

        $this->fill($fill);

        return $this;

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
