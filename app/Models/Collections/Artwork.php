<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents a work of art in our collections.
 */
class Artwork extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    public function artists()
    {

        return $this->belongsToMany('App\Models\Collections\Artist', 'agent_artwork', 'artwork_citi_id', 'agent_citi_id');

    }

    public function copyrightRepresentatives()
    {

        return $this->belongsToMany('App\Models\Collections\CopyrightRepresentative', 'agent_artwork', 'artwork_citi_id', 'agent_citi_id');

    }

    public function department()
    {

        return $this->belongsTo('App\Models\Collections\Department');

    }

    public function objectType()
    {

        return $this->belongsTo('App\Models\Collections\ObjectType');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category');

    }

    public function dates()
    {

        return $this->hasMany('App\Models\Collections\ArtworkDate');

    }

    public function committees()
    {

        return $this->hasMany('App\Models\Collections\ArtworkCommittee');

    }

    public function terms()
    {

        return $this->hasMany('App\Models\Collections\ArtworkTerm');

    }

    public function catalogues()
    {

        return $this->hasMany('App\Models\Collections\ArtworkCatalogue');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Models\Collections\Gallery');

    }

    public function parts()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_artwork', 'set_citi_id', 'part_citi_id');

    }

    public function sets()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_artwork', 'part_citi_id', 'set_citi_id');

    }

    public function images()
    {

        return $this->belongsToMany('App\Models\Collections\Image')->withPivot('preferred');

    }

    public function mobileArtwork()
    {

        return $this->hasOne('App\Models\Mobile\Artwork');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'citi_id' => $source->id,
            'lake_guid' => $source->lake_guid,
            'main_id' => $source->main_id,
            'date_display' => $source->date_display,
            'date_start' => $source->date_start,
            'date_end' => $source->date_end,
            'artist_display' => $source->creator_display,
            'dimensions' => $source->dimensions,
            'medium' => $source->medium,
            'credit_line' => $source->credit_line,
            'inscriptions' => $source->inscriptions,
            'publication_history' => $source->publications,
            'exhibition_history' => $source->exhibitions,
            'provenance' => $source->provenance,
            'description' => $source->description,
            'publishing_verification_level' => null,
            'is_public_domain' => null,
            'copyright_notice' => $source->copyright ? reset($source->copyright) : null,
            'place_of_origin' => null,
            'collection_status' => null,
            'department_citi_id' => $source->department_id,
            //'object_type_citi_id' => ,
            //'gallery_citi_id' => ,
            'source_created_at' => strtotime($source->created_at),
            'source_modified_at' => strtotime($source->modified_at),
            'source_indexed_at' => strtotime($source->indexed_at),
        ];

    }

    public function attachFrom($source)
    {

        if ($source->creator_id)
        {

            $this->artists()->sync([$source->creator_id], false);

        }

        if ($source->image_guid)
        {

            // https://stackoverflow.com/questions/27230672/laravel-sync-how-to-sync-an-array-and-also-pass-additional-pivot-fields
            // This is how we sync w/ an additional attribute on the pivot table
            $this->images()->sync([
                $source->image_guid => [
                    'preferred' => true
                ]
            ], false);

        }


        if ($source->department_id)
        {

            // Sync is unnecessary here, since it's just a column on this table
            $this->department_citi_id = $source->department_id;

        }

        if ($source->category_ids)
        {

            $this->categories()->sync($source->category_ids, false);

        }

        // @TODO Sync the following when they become available
        // $source->document_guids
        // $source->copyright_representative_ids
        // $source->committee_ids
        // $source->term_ids
        // $source->date_ids [verify?]
        // $source->catalogue_ids [verify?]
        // $source->part_ids

        // update artworks with gallery id and object type id

        return $this;

    }


    /**
     * Get the models representing our essential artworks from the database.
     *
     * Artworks from three different catalogues: Paintings at the Art Institute of Chicago: Highlights of the Collection,
     * The Essential Guide, and Master Paintings in the Art Institute of Chicago.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getEssentialIds() {

        return [
            185651,183077,151358,99539,189595,187528,102611,111401,91620,18757,51185,55249,14968,65290,75644,
            106538,59787,103347,104094,100829,76571,154237,154238,149776,120154,44018,56905,102295,105105,184672,
            111442,25865,72801,97916,190558,36161,15401,69780,64724,185905,65916,40619,151371,63178,104031,
            46327,6565,83905,111628,117266,56682,156538,196323,71829,105203,131541,192890,104043,189289,189290,
            144272,190224,102963,191197,188540,188845,64339,159136,70207,185963,70003,35376,42566,88724,43060,
            76279,183277,73216,185180,111380,56731,9512,11272,127644,185222,88977,89856,24645,153244,24548,
            21023,13853,34286,49195,86340,142526,58540,69109,99766,16964,73417,79379,76244,83642,157156,
            100472,4884,147003,86385,146991,186049,71396,35198,97402,68823,102234,184362,146988,93345,191371,
            47149,90583,107069,110634,100250,160222,147513,146989,76054,90443,187165,157160,159824,192689,137125,
            148306,140645,186392,182728,154232,184193,184186,181091,160226,181774,189207,184095,181145,34116,156442,
            189715,57819,126981,147508,6596,50330,68769,186047,103943,111400,107300,148412,43714,46230,50909,
            25332,52560,16231,15468,16169,184324,16327,184371,23972,25853,199854,112092,44741,87479,84709,
            27310,73413,95998,11434,5848,60755,16488,4788,93900,57051,27307,16362,102591,111317,110663,
            144969,4758,4796,44892,14598,81512,11723,20684,81558,14655,11320,110507,14572,27992,16487,
            80607,19339,28560,64818,61128,60812,111436,28067,16568,87045,109330,66039,79307,111060,9503,
            8624,8991,80062,185766,30839,27987,91194,144361,2816,109819,153701,109275,27984,7124,111654,
            118746,37761,185760,72728,5357,61608,185184,84241,151424,59426,34181,111642,20509,38930,145681,
            63554,157056,66683,66434,119454,55384,70739,50157,100079,50148,13720,100089,87163,63234,188844,
            191454,117271,160201,187155,110881,23506,105073,60031,90536,20432,103887,76295,102131,52736,50276,
            76779,61603,111164,160144,18709,16776,76395,72726,70202,23684,135430,83889,111810,131385,122054,
            90300,99602,149681,85533,189600,36132,70443,80479,189775,52679,86421,49691,150739,180298,185619,
            155969,64884,109686,16298,4575,4081,105466,59847,62042,80084,146953,869,43145,23333,111610,
            111559,4773,4428,16499,14574,20579,16571,14591,16146,62371,154235,109926,49702,150054,55706,
            90048,30709,146701,81564,28849,111377,97910,64729,8958,31285,87643,119521,76240,109780,79600,
            23700,65868,93811,61428,64276,111617,117188,49714,125660,2189,146905,89403,127859,88793,79507,
            92975,234781,76816,76869,210511,193664,210482,16551,11393,7021,207293,156474,234972,49686,105800,
            118661,217201,191556,198809,34299,15563,220272,229354,229351,229406,223309,129884,234004,227420,24836,
            234433,218612,199002,229510,189932,230189,225016,221885,229866
        ];

    }


    /**
     * Get the models representing our essential artworks from the database.
     *
     * Artworks from three different catalogues: Paintings at the Art Institute of Chicago: Highlights of the Collection,
     * The Essential Guide, and Master Paintings in the Art Institute of Chicago.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function essentials()
    {

        return (new static)->newQuery()->whereKey( static::getEssentialIds() );

    }


    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'main_reference_number' => [
                "doc" => "Unique identifier assigned to the artwork upon acquisition",
                "type" => "string",
                "value" => function() { return $this->main_id; },
            ],
            'date_start' => [
                "doc" => "The year of the period of time associated with the creation of this work",
                "type" => "number",
                "value" => function() { return $this->date_start; },
            ],
            'date_end' => [
                "doc" => "The year of the period of time associated with the creation of this work",
                "type" => "number",
                "value" => function() { return $this->date_end; },
            ],
            'date_display' => [
                "doc" => "Readable, free-text description of the period of time associated with the creation of this work. This might include date terms like Dynasty, Era etc. Written by curators and editors in house style, and is the preferred field for display on websites and apps. ",
                "type" => "string",
                "value" => function() { return $this->date_display; },
            ],
            'description' => [
                "doc" => "Longer explanation describing the work",
                "type" => "string",
                "value" => function() { return $this->description; },
            ],
            'artist_display' => [
                "doc" => "Readable description of the creator of this work. Includes artist names, nationality and lifespan dates",
                "type" => "string",
                "value" => function() { return $this->artist_display; },
            ],
            'department' => [
                "doc" => "Name of the curatorial department that this work belongs to",
                "type" => "string",
                "value" => function() { return $this->department ? $this->department->title : NULL; },
            ],
            'department_id' => [
                "doc" => "Unique identifier of the curatorial department that this work belongs to",
                "type" => "number",
                "value" => function() { return $this->department ? $this->department_citi_id : null; },
            ],
            'dimensions' => [
                "doc" => "The size, shape, scale, and dimensions of the work. May include multiple dimension like overall, frame, or dimension for each section of a work. Free-form text formatted in a house style.",
                "type" => "string",
                "value" => function() { return $this->dimensions; },
            ],
            'medium' => [
                "doc" => "The substances or materials used in the creation of a work",
                "type" => "string",
                "value" => function() { return $this->medium_display; },
            ],
            'inscriptions' => [
                "doc" => "A description of distinguishing or identifying physical markings that are on the work",
                "type" => "string",
                "value" => function() { return $this->inscriptions; },
            ],
            'object_type' => [
                "doc" => "The kind of object or work, e.g., Painting, Sculpture, Book, etc.",
                "type" => "string",
                "value" => function() { return $this->objectType ? $this->objectType->title : NULL; },
            ],
            'object_type_id' => [
                "doc" => "Unique identifier of the kind of object or work",
                "type" => "number",
                "value" => function() { return $this->objectType ? $this->objectType->citi_id : null; },
            ],
            'credit_line' => [
                "doc" => "Brief statement indicating how the work came into the collection",
                "type" => "string",
                "value" => function() { return $this->credit_line; },
            ],
            'publication_history' => [
                "doc" => "Bibliographic list of all the places this work has been published",
                "type" => "string",
                "value" => function() { return $this->publication_history; },
            ],
            'exhibition_history' => [
                "doc" => "List of all the places this work has been exhibited",
                "type" => "string",
                "value" => function() { return $this->exhibition_history; },
            ],
            'provenance_text' => [
                "doc" => "Ownership/collecting history of the work. May include names of owners, dates, and possibly methods of transfer of ownership. Free-form text formatted in a house style.",
                "type" => "string",
                "value" => function() { return $this->provenance; },
            ],
            'publishing_verification_level' => [
                "doc" => "Indicator of how much metadata on the work in published. Web Basic is the least amount, Web Everything is the greatest.",
                "type" => "string",
                "value" => function() { return $this->publishing_verification_level; },
            ],
            'is_public_domain' => [
                "doc" => "Whether the work is in the public domain, meaning it was created before copyrights existed or has left the copyright term",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_public_domain; },
            ],
            'copyright_notice' => [
                "doc" => "Statement notifying how the work is protected by copyright. Applies to the work itself, not image or other related assets.",
                "type" => "string",
                "value" => function() { return $this->copyright_notice; },
            ],
            'place_of_origin' => [
                "doc" => "The location where the creation, design, or production of the work took place, or the original location of the work",
                "type" => "string",
                "value" => function() { return $this->place_of_origin; },
            ],
            'collection_status' => [
                "doc" => "The works status of belonging to our collection. Values include 'Permanent Collection', 'Ryerson Collection', and 'Long-term Loan'.",
                "type" => "string",
                "value" => function() { return $this->collection_status; },
            ],
            'gallery' => [
                "doc" => "The location of this work in our museum",
                "type" => "string",
                "value" => function() { return $this->gallery ? $this->gallery->title : ''; },
            ],
            'gallery_id' => [
                "doc" => "Unique identifier of the location of this work in our museum",
                "type" => "number",
                "value" => function() { return $this->gallery ? $this->gallery->citi_id : null; },
            ],
            'is_in_gallery' => [
                "doc" => "Whether the work is on display",
                "type" => "boolean",
                "value" => function() { return $this->gallery ? true : false; },
            ],
            'latitude' => [
                "doc" => "Latitude coordinate of the location of this work in our galleries",
                "type" => "number",
                "value" => function() { return $this->mobileArtwork ? $this->mobileArtwork->latitude : NULL; },
            ],
            'longitude' => [
                "doc" => "Longitude coordinate of the location of this work in our galleries",
                "type" => "number",
                "value" => function() { return $this->mobileArtwork ? $this->mobileArtwork->longitude : NULL; },
            ],
            'latlon' => [
                "doc" => "Latitude and longitude coordinates of the location of this work in our galleries",
                "type" => "string",
                "value" => function() { return $this->mobileArtwork ? ($this->mobileArtwork->latitude .',' .$this->mobileArtwork->longitude) : NULL; },
            ],
            'is_highlighted_in_mobile' => [
                "doc" => "Whether the work is highlighted in the mobile app",
                "type" => "boolean",
                "value" => function() { return (bool) $this->mobileArtwork ? $this->mobileArtwork->highlighted : NULL; },
            ],
            'selector_number' => [
                "doc" => "The code that can be entered in our audioguides to learn more about this work",
                "type" => "number",
                "value" => function() { return $this->mobileArtwork ? $this->mobileArtwork->selector_number : NULL; },
            ],
            'artist_ids' => [
                "doc" => "Unique identifiers of the artists associated with this work",
                "type" => "array",
                "value" => function() { return $this->artists->pluck('citi_id')->all(); },
            ],
            'category_ids' => [
                "doc" => "Unique identifiers of the categories this work is a part of",
                "type" => "array",
                "value" => function() { return $this->categories->pluck('citi_id')->all(); },
            ],
            'copyright_representative_ids' => [
                "doc" => "Unique identifiers of the copyright representatives associated with this work",
                "type" => "array",
                "value" => function() { return $this->copyrightRepresentatives->pluck('citi_id')->all(); },
            ],
            'part_ids' => [
                "doc" => "Unique identifiers of the individual works that make up this work",
                "type" => "array",
                "value" => function() { return $this->parts->pluck('citi_id')->all(); },
            ],
            'set_ids' => [
                "doc" => "Unique identifiers of the sets this work is a part of. These are not artwork ids.",
                "type" => "array",
                "value" => function() { return $this->sets->pluck('citi_id')->all(); },
            ],
            'date_dates' => [
                "doc" => "List of all the dates associated with this work. Includes creation dates, and may also include publication dates for works on paper, exhibition dates for provenance, found dates for archaeological finds, etc.",
                "type" => "array",
                "value" => function() { return $this->dates()->pluck('date')->transform(function ($item, $key) { 
                    return $item->toIso8601String();
                })->all(); },
            ],
            'catalogue_titles' => [
                "doc" => "A catalogue raisonné is a comprehensive, annotated listing of all the known artworks by an artist. This list represents all the catalogues this work is included in. This isn't an exhaustive list of publications where the work has been mentioned. For that, see `publication_history`.",
                "type" => "array",
                "value" => function() { return $this->catalogues->pluck('catalogue')->all(); },
            ],
            'committee_titles' => [
                "doc" => "List of committees which were involved in the acquisition or deaccession of this work",
                "type" => "array",
                "value" => function() { return $this->committees->pluck('committee')->all(); },
            ],
            'term_titles' => [
                "doc" => "The names of the taxonomy tags for this work",
                "type" => "array",
                "value" => function() { return $this->terms->pluck('term')->all(); },
            ],
            'preferred_image_id' => [
                "doc" => "Unique identifier of the preferred image to use to represent this work",
                "type" => "number",
                "value" => function() {
                    $preferred_image = $this->images()->wherePivot('preferred','=',true)->get()->first();
                    return $preferred_image ? $preferred_image->lake_guid : null;
                },
            ],
            'preferred_image_iiif_url' => [
                "doc" => "IIIF URL of the preferred image to use to represent this work",
                "type" => "string",
                "value" => function() {
                    $preferred_image = $this->images()->wherePivot('preferred','=',true)->get()->first();
                    return $preferred_image ? $preferred_image->iiif_url : null;
                },
            ],
            'image_ids' => [
                "doc" => "Unique identifiers of all the images of this work. The order of this list will not correspond to the order of `image_iiif_urls`.",
                "type" => "number",
                "value" => function() { return $this->images->pluck('lake_guid')->all(); },
            ],
            'image_iiif_urls' => [
                "doc" => "IIIF URLs of all the images of this work. The order of this list will not correspond to the order of `image_ids`.",
                "type" => "array",
                "value" => function() { return $this->images->pluck('iiif_url')->all(); },
            ],
            'tour_ids' => [
                "doc" => "Unique identifiers of the tours this work is included in",
                "type" => "array",
                "value" => function() { return $this->mobileArtwork ? ( $this->mobileArtwork->stops->map( function( $stop ) {  return $stop->tour; })->pluck('mobile_id')->all() ) : []; },
            ],
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            'artist_titles' => $this->artists->pluck('title')->all(),
            // @TODO category_titles?
            'copyright_representative_titles' => $this->copyrightRepresentatives->pluck('title')->all(),
            'part_titles' => $this->parts->pluck('title')->all(),
            'set_titles' => $this->sets->pluck('title')->all(),
            //'tour_titles' => $this->mobileArtwork ? $this->mobileArtwork->tours->pluck('title')->all() : [],

        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'main_reference_number' => [
                    'type' => 'keyword',
                ],
                'date_display' => [
                    'type' => 'keyword',
                ],
                'date_start' => [
                    'type' => 'integer',
                ],
                'date_end' => [
                    'type' => 'integer',
                ],
                'artist_display' => [
                    'type' => 'text',
                ],
                'department' => [
                    'type' => 'text',
                ],
                'department_id' => [
                    'type' => 'integer',
                ],
                'dimensions' => [
                    'type' => 'keyword',
                ],
                'medium' => [
                    'type' => 'text',
                ],
                'inscriptions' => [
                    'type' => 'text',
                ],
                'object_type' => [
                    'type' => 'text',
                ],
                'object_type_id' => [
                    'type' => 'integer',
                ],
                'credit_line' => [
                    'type' => 'text',
                ],
                'publication_history' => [
                    'type' => 'text',
                ],
                'exhibition_history' => [
                    'type' => 'text',
                ],
                'provenance_text' => [
                    'type' => 'text',
                ],
                'publishing_verification_level' => [
                    'type' => 'keyword',
                ],
                'is_public_domain' => [
                    'type' => 'boolean',
                ],
                'copyright_notice' => [
                    'type' => 'text',
                ],
                'place_of_origin' => [
                    'type' => 'text',
                ],
                'collection_status' => [
                    'type' => 'text',
                ],
                'gallery' => [
                    'type' => 'text',
                ],
                'gallery_id' => [
                    'type' => 'integer',
                ],
                'is_in_gallery' => [
                    'type' => 'boolean',
                ],
                // TODO: Move these to Mobile\Artwork
                'latitude' => [
                    'type' => 'float',
                ],
                'longitude' => [
                    'type' => 'float',
                ],
                'latlon' => [
                    'type' => 'geo_point',
                ],
                'is_highlighted_in_mobile' => [
                    'type' => 'boolean',
                ],
                'selector_number' => [
                    'type' => 'integer',
                ],
                // EOF TODO Mobile\Artwork
                'artist_ids' => [
                    'type' => 'integer',
                ],
                'artist_titles' => [
                    'type' => 'text',
                ],
                'category_ids' => [
                    'type' => 'integer',
                ],
                'category_titles' => [
                    'type' => 'text',
                ],
                'copyright_representative_ids' => [
                    'type' => 'integer',
                ],
                'copyright_representative_titles' => [
                    'type' => 'text',
                ],
                'part_ids' => [
                    'type' => 'integer',
                ],
                'part_titles' => [
                    'type' => 'text',
                ],
                'set_ids' => [
                    'type' => 'integer',
                ],
                'set_titles' => [
                    'type' => 'text',
                ],
                'date_dates' => [
                    'type' => 'date',
                ],
                'catalogue_titles' => [
                    'type' => 'text',
                ],
                'committee_titles' => [
                    'type' => 'text',
                ],
                'term_titles' => [
                    'type' => 'text',
                ],
                'image_urls' => [
                    'type' => 'keyword',
                ],
                // TODO: Move these to Mobile\Artwork
                'tour_ids' => [
                    'type' => 'integer',
                ],
                'tour_titles' => [
                    'type' => 'text',
                ],
            ];

    }


    /**
     * Get the subresources for the resource.
     *
     * @return array
     */
    public function subresources()
    {

        return ['artists', 'copyrightRepresentatives', 'categories', 'images', 'parts', 'sets'];

    }

    /**
     * Get the subresources to skip the example output for.
     *
     * @return array
     */
    public function subresourcesToSkipExampleOutput()
    {

        return ['parts', 'sets'];

    }

    /**
     * Get any extra descriptions of the search endpoint for this resource
     *
     * @return string
     */
    public function extraSearchDescription()
    {

        return "Artworks in the groups of essentials are boosted so they'll show up higher in results.";

    }

    /**
     * Get an example search query for documentation generation
     *
     * @return string
     */
    public function exampleSearchQuery()
    {

        return 'q=monet';

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "111628";

    }

}
