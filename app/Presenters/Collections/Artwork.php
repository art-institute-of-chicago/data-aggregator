<?php

namespace App\Presenters\Collections;

use App\Presenters\BasePresenter;

class Artwork extends BasePresenter
{

    /**
     * Name of the resource
     *
     * @type string
     */
    public function title()
    {

        return $this->entity->title;

    }

    /**
     * Alternate names for this work
     *
     * @type array
     */
    public function alt_titles()
    {

        return [];

    }

    /**
     * Unique identifier assigned to the artwork upon acquisition
     *
     * @type string
     */
    public function main_reference_number()
    {

        return $this->entity->main_id;

    }

    /**
     * The year of the period of time associated with the creation of this work
     *
     * @type number
     */
    public function date_start()
    {

        return $this->entity->date_start;

    }

    /**
     * The year of the period of time associated with the creation of this work
     *
     * @type number
     */
    public function date_end()
    {

        return $this->entity->date_end;

    }

    /**
     * Readable, free-text description of the period of time associated with the creation of this work. This might
     * include date terms like Dynasty, Era etc. Written by curators and editors in house style, and is the preferred
     * field for display on websites and apps.
     *
     * @type string
     */
    public function date_display()
    {

        return $this->entity->date_display;

    }

    /**
     * Longer explanation describing the work
     *
     * @type string
     */
    public function description()
    {

        return $this->entity->description;

    }

    /**
     * Readable description of the creator of this work. Includes artist names, nationality and lifespan dates
     *
     * @type string
     */
    public function artist_display()
    {

        return $this->entity->artist_display;

    }

    /**
     * Name of the curatorial department that this work belongs to
     *
     * @type string
     */
    public function department()
    {

        return $this->entity->department ? $this->entity->department->title : NULL;

    }

    /**
     * Unique identifier of the curatorial department that this work belongs to
     *
     * @type number
     */
    public function department_id()
    {

        return $this->entity->department ? $this->entity->department->citi_id : NULL;

    }

    /**
     * The size, shape, scale, and dimensions of the work. May include multiple dimension like overall, frame, or
     * dimension for each section of a work. Free-form text formatted in a house style.
     *
     * @type string
     */
    public function dimensions()
    {

        return $this->entity->dimensions;

    }

    /**
     * The substances or materials used in the creation of a work
     *
     * @type string
     */
    public function medium()
    {

        return $this->entity->medium_display;

    }

    /**
     * A description of distinguishing or identifying physical markings that are on the work
     *
     * @type string
     */
    public function inscriptions()
    {

        return $this->entity->inscriptions;

    }

    /**
     * The kind of object or work, e.g., Painting, Sculpture, Book, etc.
     *
     * @type string
     */
    public function object_type()
    {

        return $this->objectType ? $this->objectType->title : NULL;

    }

    /**
     * Unique identifier of the kind of object or work
     *
     * @type number
     */
    public function object_type_id()
    {

        return $this->objectType ? $this->objectType->citi_id : NULL;

    }

    /**
     * Brief statement indicating how the work came into the collection
     *
     * @type string
     */
    public function credit_line()
    {

        return $this->credit_line;

    }

    /**
     * Bibliographic list of all the places this work has been published
     *
     * @type string
     */
    public function publication_history()
    {

        return $this->publication_history;

    }

    /**
     * List of all the places this work has been exhibited
     *
     * @type string
     */
    public function exhibition_history()
    {

        return $this->exhibition_history;

    }

    /**
     * Ownership/collecting history of the work. May include names of owners, dates, and possibly methods of transfer of
     * ownership. Free-form text formatted in a house style.
     *
     * @type string
     */
    public function provenance_text()
    {

        return $this->provenance;

    }

    /**
     * Indicator of how much metadata on the work in published. Web Basic is the least amount, Web Everything is the
     * greatest.
     *
     * @type string
     */
    public function publishing_verification_level()
    {

        return $this->publishing_verification_level;

    }

    /**
     * Whether the work is in the public domain, meaning it was created before copyrights existed or has left the copyright term
     *
     * @type boolean
     */
    public function is_public_domain()
    {

        return (bool) $this->is_public_domain;

    }

    /**
     * Whether images of the work are allowed to be displayed in a zoomable interface.
     *
     * @type boolean
     */
    public function is_zoomable()
    {

        return (bool) false;

    }


    /*
            [
                "name" => 'max_zoom_window_size',
                "doc" => "The maximum size of the window the image is allowed to be viewed in, in pixels.",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return 843; },
            ],
            [
                "name" => 'copyright_notice',
                "doc" => "Statement notifying how the work is protected by copyright. Applies to the work itself, not image or other related assets.",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->copyright_notice; },
            ],
            [
                "name" => 'fiscal_year',
                "doc" => "The fiscal year in which the work was acquired.",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return null; },
            ],
            [
                "name" => 'place_of_origin',
                "doc" => "The location where the creation, design, or production of the work took place, or the original location of the work",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->place_of_origin; },
            ],
            [
                "name" => 'collection_status',
                "doc" => "The works status of belonging to our collection. Values include 'Permanent Collection', 'Ryerson Collection', and 'Long-term Loan'.",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->collection_status; },
            ],
            [
                # TODO: Handle titles holistically, for everything!
                "name" => 'gallery_title',
                "doc" => "The location of this work in our museum",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->gallery ? $this->gallery->title : null; },
            ],
            [
                "name" => 'gallery_id',
                "doc" => "Unique identifier of the location of this work in our museum",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->gallery ? $this->gallery->citi_id : null; },
            ],
            // TODO: Version our API!
            [
                "name" => 'is_in_gallery',
                "doc" => "[DEPRECATED] Whether the work is on display",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->gallery && !$this->gallery->closed ? true : false; },
            ],
            [
                "name" => 'is_on_view',
                "doc" => "Whether the work is on display",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->gallery && !$this->gallery->closed ? true : false; },
            ],
            // TODO: Move these to Mobile\Artwork
            [
                "name" => 'latitude',
                "doc" => "Latitude coordinate of the location of this work in our galleries",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->mobileArtwork ? $this->mobileArtwork->latitude : NULL; },
            ],
            [
                "name" => 'longitude',
                "doc" => "Longitude coordinate of the location of this work in our galleries",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->mobileArtwork ? $this->mobileArtwork->longitude : NULL; },
            ],
            [
                "name" => 'latlon',
                "doc" => "Latitude and longitude coordinates of the location of this work in our galleries",
                "type" => "string",
                'elasticsearch_type' => 'geo_point',
                "value" => function() { return $this->mobileArtwork ? ($this->mobileArtwork->latitude .',' .$this->mobileArtwork->longitude) : NULL; },
            ],
            [
                "name" => 'is_highlighted_in_mobile',
                "doc" => "Whether the work is highlighted in the mobile app",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->mobileArtwork ? $this->mobileArtwork->highlighted : false; },
            ],
            [
                "name" => 'selector_number',
                "doc" => "The code that can be entered in our audioguides to learn more about this work",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->mobileArtwork ? $this->mobileArtwork->selector_number : NULL; },
            ],
            // EOF TODO Mobile\Artwork
            [
                "name" => 'artist_id',
                "doc" => "Unique identifier of the preferred artist/culture associated with this work",
                "type" => "integer",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artists->pluck('citi_id')->first(); },
            ],
            [
                "name" => 'alt_artist_ids',
                "doc" => "Unique identifiers of the non-preferred artists/cultures associated with this work",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artists->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'category_ids',
                "doc" => "Unique identifiers of the categories this work is a part of",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->categories->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'copyright_representative_ids',
                "doc" => "Unique identifiers of the copyright representatives associated with this work",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->copyrightRepresentatives->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'part_ids',
                "doc" => "Unique identifiers of the individual works that make up this work",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->parts->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'set_ids',
                "doc" => "Unique identifiers of the sets this work is a part of. These are not artwork ids.",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->sets->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'date_dates',
                "doc" => "List of all the dates associated with this work. Includes creation dates, and may also include publication dates for works on paper, exhibition dates for provenance, found dates for archaeological finds, etc.",
                "type" => "array",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->dates()->pluck('date')->transform(function ($item, $key) {
                    return $item->toIso8601String();
                })->all(); },
            ],
            [
                "name" => 'artwork_catalogue_ids',
                "doc" => "This list represents all the catalogues this work is included in. This isn't an exhaustive list of publications where the work has been mentioned. For that, see `publication_history`.",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artworkCatalogues->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'committee_titles',
                "doc" => "List of committees which were involved in the acquisition or deaccession of this work",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->committees->pluck('committee')->all(); },
            ],
            [
                "name" => 'term_titles',
                "doc" => "The names of the taxonomy tags for this work",
                "type" => "array",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->terms->pluck('title')->all(); },
            ],
            [
                "name" => 'style_id',
                "doc" => "Unique identifier of the preferred style term for this work",
                "type" => "number",
                "elasticsearch_type" => "integer",
                "value" => function() { return $this->styles->where('pivot.preferred', true)->pluck('citi_id')->first(); },
            ],
            [
                "name" => 'alt_style_ids',
                "doc" => "Unique identifiers of all other non-preferred style terms for this work",
                "type" => "array",
                "elasticsearch_type" => "integer",
                "value" => function() { return $this->styles->where('pivot.preferred', false)->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'classification_id',
                "doc" => "Unique identifier of the preferred classification term for this work",
                "type" => "number",
                "elasticsearch_type" => "integer",
                "value" => function() { return $this->classifications->where('pivot.preferred', true)->pluck('citi_id')->first(); },
            ],
            [
                "name" => 'alt_classificaiton_ids',
                "doc" => "Unique identifiers of all other non-preferred classification terms for this work",
                "type" => "array",
                "elasticsearch_type" => "integer",
                "value" => function() { return $this->classifications->where('pivot.preferred', false)->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'subject_id',
                "doc" => "Unique identifier of the preferred subject term for this work",
                "type" => "number",
                "elasticsearch_type" => "integer",
                "value" => function() { return $this->subjects->where('pivot.preferred', true)->pluck('citi_id')->first(); },
            ],
            [
                "name" => 'alt_subject_ids',
                "doc" => "Unique identifiers of all other non-preferred subject terms for this work",
                "type" => "array",
                "elasticsearch_type" => "integer",
                "value" => function() { return $this->subjects->where('pivot.preferred', false)->pluck('citi_id')->all(); },
            ],

            // This field is added to the Elasticsearch schema manually via elasticsearchMappingFields
            [
                "name" => 'color',
                "doc" => "Dominant color of this image in HSL",
                "type" => "object",
                "value" => function() {
                    $preferred_image = $this->images()->wherePivot('preferred','=',true)->get()->first();
                    return ($preferred_image && $preferred_image->metadata && $preferred_image->metadata->color ? $preferred_image->metadata->color : null);
                },
            ],
            [
                "name" => 'image_id',
                "doc" => "Unique identifier of the preferred image to use to represent this work",
                "type" => "uuid",
                'elasticsearch_type' => 'keyword',
                "value" => function() {
                    $preferred_image = $this->images()->wherePivot('preferred','=',true)->get()->first();
                    return $preferred_image ? $preferred_image->lake_guid : null;
                },
            ],
            [
                "name" => 'image_iiif_url',
                "doc" => "IIIF URL of the preferred image to use to represent this work",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() {
                    $preferred_image = $this->images()->wherePivot('preferred','=',true)->get()->first();
                    return $preferred_image ? $preferred_image->iiif_url : null;
                },
            ],
            [
                "name" => 'alt_image_ids',
                "doc" => "Unique identifiers of all non-preferred images of this work. The order of this list will not correspond to the order of `image_iiif_urls`.",
                "type" => "array",
                'elasticsearch_type' => 'keyword',
                "value" => function() {
                    $alt_images = $this->images()->wherePivot('preferred','=',false)->get()->all();
                    return $alt_images ? $alt_images->pluck('lake_guid')->all() : null;
                },
            ],
            [
                "name" => 'alt_image_iiif_urls',
                "doc" => "IIIF URLs of all the images of this work. The order of this list will not correspond to the order of `image_ids`.",
                "type" => "array",
                'elasticsearch_type' => 'keyword',
                "value" => function() {
                    $alt_images = $this->images()->wherePivot('preferred','=',false)->get()->all();
                    return $alt_images ? $alt_images->pluck('iiif_url')->all() : null;
                },
            ],
            // TODO: Move these to Mobile\Artwork
            [
                "name" => 'tour_stop_ids',
                "doc" => "Unique identifiers of the tour stops this work is included in",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->mobileArtwork ? ( $this->mobileArtwork->stops->pluck('id')->all() ) : []; },
            ],
            [
                "name" => 'section_ids',
                "doc" => "Unique identifiers of the digital publication chaptes this work in included in",
                "type" => "array",
                'elasticsearch_type' => 'string',
                "value" => function() { return $this->sections->pluck('dsc_id')->all(); },
            ],
            [
                "name" => 'site_ids',
                "doc" => "Unique identifiers of the microsites this work is a part of",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->sites->pluck('site_id')->all(); },
            ],
        ];
    */
}
