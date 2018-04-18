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
    use Documentable {
        docBoostedDescription as public traitDocBoostedDescription;
    }

    protected $casts = [
        'alt_titles' => 'array',
    ];

    protected $primaryKey = 'citi_id';

    protected $dates = [
        'source_created_at',
        'source_modified_at',
        'source_indexed_at',
        'citi_created_at',
        'citi_modified_at',
    ];

    public function thumbnail()
    {

        // TODO: Change this to be polymorphic + use its own table?
        return $this->image();

    }

    public function artistPivots()
    {

        return $this->hasMany('App\Models\Collections\ArtworkArtistPivot');

    }

    public function artists()
    {

        return $this->belongsToMany('App\Models\Collections\Agent', 'artwork_artist')
            ->using('App\Models\Collections\ArtworkArtistPivot')
            ->withPivot('preferred');

    }

    public function artist()
    {

        return $this->artists()->isPreferred();

    }

    public function altArtists()
    {

        return $this->artists()->isAlternative();

    }

    public function artworkType()
    {

        return $this->belongsTo('App\Models\Collections\ArtworkType');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category');

    }

    public function department()
    {

        return $this->categories()->where('type', 1)->where('parent_id', null)->expectOne();

    }

    public function dates()
    {

        return $this->hasMany('App\Models\Collections\ArtworkDate');

    }

    public function terms()
    {

        return $this->belongsToMany('App\Models\Collections\Term');

    }

    public function styles()
    {

        return $this->belongsToMany('App\Models\Collections\Term')->where('term_type_id', '=', TermType::STYLE)->withPivot('preferred');

    }

    public function style()
    {

        return $this->styles()->isPreferred();

    }

    public function altStyles()
    {

        return $this->styles()->isAlternative();

    }


    public function classifications()
    {

        return $this->belongsToMany('App\Models\Collections\Term')->where('term_type_id', '=', TermType::CLASSIFICATION)->withPivot('preferred');

    }

    public function classification()
    {

        return $this->classifications()->isPreferred();

    }

    public function altClassifications()
    {

        return $this->classifications()->isAlternative();

    }

    public function subjects()
    {

        return $this->belongsToMany('App\Models\Collections\Term')->where('term_type_id', '=', TermType::SUBJECT)->withPivot('preferred');

    }

    public function subject()
    {

        return $this->subjects()->isPreferred();

    }

    public function altSubjects()
    {

        return $this->subjects()->isAlternative();

    }

    public function materials()
    {

        return $this->belongsToMany('App\Models\Collections\Term')->where('term_type_id', '=', TermType::MATERIAL)->withPivot('preferred');

    }

    public function material()
    {

        return $this->materials()->isPreferred();

    }

    public function altMaterials()
    {

        return $this->materials()->isAlternative();

    }

    public function artworkCatalogues()
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

        return $this->belongsToMany('App\Models\Collections\Image', 'artwork_asset', 'artwork_citi_id', 'asset_lake_guid')
            // ->where('type', 'image') // Do we need these if we're targeting Image i/o Asset?
            ->withPivot('preferred')
            ->withPivot('is_doc')
            ->wherePivot('is_doc', '=', false);

    }

    public function image()
    {

        return $this->images()->isPreferred();

    }

    public function altImages()
    {

        return $this->images()->isAlternative();

    }

    public function assets()
    {

        return $this->belongsToMany('App\Models\Collections\Asset')->withPivot('is_doc');

    }

    public function documents()
    {

        return $this->assets()->wherePivot('is_doc', '=', true);

    }

    public function sounds()
    {

        return $this->belongsToMany('App\Models\Collections\Sound', 'artwork_asset', 'artwork_citi_id', 'asset_lake_guid')->where('type', 'sound');

    }

    public function videos()
    {

        return $this->belongsToMany('App\Models\Collections\Video', 'artwork_asset', 'artwork_citi_id', 'asset_lake_guid')->where('type', 'video');

    }

    public function texts()
    {

        return $this->belongsToMany('App\Models\Collections\Text', 'artwork_asset', 'artwork_citi_id', 'asset_lake_guid')->where('type', 'text');

    }

    public function mobileArtwork()
    {

        return $this->hasOne('App\Models\Mobile\Artwork');

    }

    public function sections()
    {

        return $this->hasMany('App\Models\Dsc\Section');

    }

    public function sites()
    {

        return $this->belongsToMany('App\Models\StaticArchive\Site');

    }

    public function placePivots()
    {

        return $this->hasMany('App\Models\Collections\ArtworkPlacePivot');

    }

    public function places()
    {

        return $this->belongsToMany('App\Models\Collections\Place')
            ->using('App\Models\Collections\ArtworkPlacePivot')
            ->withPivot('preferred');

    }

    // Meh, we'll leave out preferred & alternative places for now

    public function getExtraFillFieldsFrom($source)
    {

        return [
            'alt_titles' => $source->alt_titles,
            'artist_display' => $source->creator_display,
            'medium_display' => $source->medium,
            'publication_history' => $source->publications,
            'exhibition_history' => $source->exhibitions,
            'copyright_notice' => $source->copyright ? reset($source->copyright) : null,
            // TODO: ArtworkTypes will need to be attached via string comparison
            //'artwork_type_citi_id' => , // Redmine #2431
            //'gallery_citi_id' => , // Redmine #2000
            'source_indexed_at' => strtotime($source->indexed_at),
        ];

    }

    public function attachFrom($source)
    {

        if ($source->artwork_agents)
        {

            $artists = collect( $source->artwork_agents ?? [] )->filter( function( $pivot ) {

                // Some artworks don't have an agent id specified here, skip them
                // TODO: Raise a validation alert?
                return (bool) $pivot->agent_id;

            })->map( function( $pivot ) {
                return [
                    $pivot->agent_id => [
                        'agent_role_citi_id' => $pivot->role_id,
                        'preferred' => $pivot->is_preferred,
                    ]
                ];
            });

            // Using collapse or array_merge was nuking numeric keys
            // $artists = $artists->collapse();
            // $artists = array_merge( ... $artists  );

            // https://stackoverflow.com/a/37748191/1943591
            $artists = array_reduce($artists->all(), function ($carry, $item) { return $carry + $item; }, []);

            $this->artists()->sync($artists);

        } elseif ($source->creator_id) {

            // In migrations, we default `preferred` to true and `agent_role_citi_id` to 219
            $this->artists()->sync([ $source->creator_id ]);

        }

        // TODO: Abstract this repetitive logic into abstract inbound transformer methods!
        if ($source->artwork_places)
        {


            $places = collect( $source->artwork_places ?? [] )->filter( function( $pivot ) {

                // Some artworks don't have an agent id specified here, skip them
                // TODO: Raise a validation alert?
                return (bool) $pivot->place_id;

            })->map( function( $pivot ) {
                return [
                    $pivot->place_id => [
                        'artwork_place_qualifier_citi_id' => $pivot->place_qualifier_id,
                        'preferred' => $pivot->is_preferred,
                    ]
                ];
            });

            // Using collapse or array_merge was nuking numeric keys
            // $places = $places->collapse();
            // $places = array_merge( ... $places  );

            // https://stackoverflow.com/a/37748191/1943591
            $places = array_reduce($places->all(), function ($carry, $item) { return $carry + $item; }, []);

            $this->places()->sync($places);

        }

        // TODO: Shared logic w/ exhibitions - abstract?
        // Start building the image sync by pulling in alts first
        $images = collect( $source->alt_image_guids ?? [] )->map( function( $image ) {
            return [
                $image => [
                    'preferred' => false,
                    'is_doc' => false,
                ]
            ];
        });

        if ($source->image_guid)
        {

            $images->push([
                $source->image_guid => [
                    'preferred' => true,
                    'is_doc' => false,
                ]
            ]);

        }

        // Collapse a collection of arrays into a single, flat collection
        $images = $images->collapse();

        // Above is how we sync w/ an additional attribute on the pivot table
        // https://stackoverflow.com/questions/27230672

        $this->images()->sync($images);

        if ($source->category_ids)
        {

            $category_ids = collect( $source->category_ids )->map( function( $id ) {
                return 'PC-' . $id;
            });

            $this->categories()->sync( $category_ids );

        }

        // This is a case where the source pivot model lack an artwork id
        if ($source->artwork_catalogue_ids)
        {

            foreach ($source->artwork_catalogue_ids as $id)
            {

                $ae = ArtworkCatalogue::find($id);
                if ($ae)
                {

                    $ae->artwork_citi_id = $this->citi_id;
                    $ae->save();

                }

            }

        }

        // TODO: Shared logic w/ exhibitions - abstract?
        if ($source->document_ids)
        {

            $documents = collect( $source->document_ids )->map( function( $document ) {
                return [
                    $document => [
                        'preferred' => false,
                        'is_doc' => true,
                    ]
                ];
            });

            $documents = $documents->collapse();

            $this->documents()->sync($documents);

        }

        if ($source->artwork_dates)
        {

            $this->dates()->delete();

            foreach ( ($source->artwork_dates ?? []) as $rec)
            {
                ArtworkDate::create([
                    'citi_id' => $rec->id,
                    'artwork_citi_id' => $this->citi_id,
                    'lake_guid' => $rec->lake_guid,
                    'date_earliest' => $rec->date_earliest,
                    'date_latest' => $rec->date_latest,
                    'preferred' => $rec->is_preferred,
                    'artwork_date_qualifier_citi_id' => $rec->date_qualifier_id,
                ]);

            }

        }

        // @TODO The following are available for syncing:
        // $source->part_ids
        // $source->set_ids

        $pref_terms = collect( $source->pref_term_ids ?? [] )->map( function( $term ) {
            return [
                ( 'TM-' . $term ) => [
                    'preferred' => true
                ]
            ];
        });

        $alt_terms = collect( $source->alt_term_ids ?? [] )->map( function( $term ) {
            return [
                ( 'TM-' . $term ) => [
                    'preferred' => false
                ]
            ];
        });

        $terms = $pref_terms->concat( $alt_terms );
        $terms = $terms->collapse();

        $this->terms()->sync($terms);

        // Galleries must be imported before artworks!
        // Waiting on Redmine #2000 to do this properly
        // Also: should Galleries be their own model?
        if ($source->location)
        {

            $gallery = \App\Models\Collections\Gallery::where('title', $source->location)->first();

            // Sometimes we get oddballs like 'Currently not on display'
            if( $gallery )
            {

                // Tag this place as a gallery ;)
                $gallery->type = 'AIC Gallery';
                $gallery->save();

                $this->gallery_citi_id = $gallery ? $gallery->citi_id : null;

            }

        }

        // update artworks with object type id

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
    public static function boostedIds() {

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
            234433,218612,199002,229510,189932,230189,225016,221885,229866,109439,869,4081,4773,16146,23333,23700,
            30709,31285,43145,49702,62042,62371,76240,79600,81564,105466,109926,111377,111559,119521,146701,146953,
            150054,238749,100858
        ];

    }

    public function isBoosted()
    {

        return in_array( $this->getKey(), static::boostedIds() );

    }

    /**
     * Get the models representing our essential artworks from the database.
     *
     * Artworks from three different catalogues: Paintings at the Art Institute of Chicago: Highlights of the Collection,
     * The Essential Guide, and Master Paintings in the Art Institute of Chicago.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function boosted()
    {

        return (new static)->newQuery()->whereKey( static::boostedIds() );

    }

    /**
     * Add relevancy tweaks to artworks.
     *
     * @return array
     */
    public static function searchBoostArtworks()
    {

        return [
            // Boost anything that's on view
            [
                'term' => [
                    'is_on_view' => [
                        'value' => true,
                        'boost' => 1.25,
                    ]
                ]
            ],
            // Boost anything that has an image
            [
                'exists' => [
                    'field' => 'image_id',
                ]
            ],
        ];

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'alt_titles',
                "doc" => "Altername names for this work",
                "type" => "array",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->alt_titles; },
            ],
            [
                "name" => 'main_reference_number',
                "doc" => "Unique identifier assigned to the artwork upon acquisition",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "boost" => 3,
                    "type" => 'keyword',
                ],
                "value" => function() { return $this->main_id; },
            ],
            [
                "name" => 'date_start',
                "doc" => "The year of the period of time associated with the creation of this work",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->date_start; },
            ],
            [
                "name" => 'date_end',
                "doc" => "The year of the period of time associated with the creation of this work",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->date_end; },
            ],
            [
                "name" => 'date_display',
                "doc" => "Readable, free-text description of the period of time associated with the creation of this work. This might include date terms like Dynasty, Era etc. Written by curators and editors in house style, and is the preferred field for display on websites and apps. ",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->date_display; },
            ],
            [
                "name" => 'description',
                "doc" => "Longer explanation describing the work",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->description; },
            ],
            [
                "name" => 'artist_display',
                "doc" => "Readable description of the creator of this work. Includes artist names, nationality and lifespan dates",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->artist_display; },
            ],
            [
                "name" => 'department_title',
                "doc" => "Name of the curatorial department that this work belongs to",
                "type" => "string",
                "value" => function() { return $this->department->title ?? null; },
            ],
            [
                "name" => 'department_id',
                "doc" => "Unique identifier of the curatorial department that this work belongs to",
                "type" => "number",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->department->lake_uid ?? null; },
            ],
            [
                "name" => 'dimensions',
                "doc" => "The size, shape, scale, and dimensions of the work. May include multiple dimension like overall, frame, or dimension for each section of a work. Free-form text formatted in a house style.",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->dimensions; },
            ],
            [
                "name" => 'medium_display',
                "doc" => "The substances or materials used in the creation of a work",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->medium_display; },
            ],
            [
                "name" => 'inscriptions',
                "doc" => "A description of distinguishing or identifying physical markings that are on the work",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->inscriptions; },
            ],
            [
                "name" => 'artwork_type_title',
                "doc" => "The kind of object or work (e.g. Painting, Sculpture, Book)",
                "type" => "string",
                "value" => function() { return $this->artworkType->title ?? null; },
            ],
            [
                "name" => 'artwork_type_id',
                "doc" => "Unique identifier of the kind of object or work",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artworkType->citi_id ?? null; },
            ],
            [
                "name" => 'credit_line',
                "doc" => "Brief statement indicating how the work came into the collection",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->credit_line; },
            ],
            [
                "name" => 'publication_history',
                "doc" => "Bibliographic list of all the places this work has been published",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->publication_history; },
            ],
            [
                "name" => 'exhibition_history',
                "doc" => "List of all the places this work has been exhibited",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->exhibition_history; },
            ],
            [
                "name" => 'provenance_text',
                "doc" => "Ownership/collecting history of the work. May include names of owners, dates, and possibly methods of transfer of ownership. Free-form text formatted in a house style.",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->provenance; },
            ],
            [
                "name" => 'publishing_verification_level',
                "doc" => "Indicator of how much metadata on the work in published. Web Basic is the least amount, Web Everything is the greatest.",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->publishing_verification_level; },
            ],
            [
                "name" => 'is_public_domain',
                "doc" => "Whether the work is in the public domain, meaning it was created before copyrights existed or has left the copyright term",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->is_public_domain; },
            ],
            [
                "name" => 'is_zoomable',
                "doc" => "Whether images of the work are allowed to be displayed in a zoomable interface.",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->is_zoomable; },
            ],
            [
                "name" => 'max_zoom_window_size',
                "doc" => "The maximum size of the window the image is allowed to be viewed in, in pixels.",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->max_zoom_window_size; },
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
                "value" => function() { return $this->gallery->title ?? null; },
            ],
            [
                "name" => 'gallery_id',
                "doc" => "Unique identifier of the location of this work in our museum",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->gallery->citi_id ?? null; },
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
                "value" => function() { return $this->mobileArtwork->latitude ?? null; },
            ],
            [
                "name" => 'longitude',
                "doc" => "Longitude coordinate of the location of this work in our galleries",
                "type" => "number",
                'elasticsearch_type' => 'float',
                "value" => function() { return $this->mobileArtwork->longitude ?? null; },
            ],
            [
                "name" => 'latlon',
                "doc" => "Latitude and longitude coordinates of the location of this work in our galleries",
                "type" => "string",
                'elasticsearch_type' => 'geo_point',
                "value" => function() { return $this->mobileArtwork ? ($this->mobileArtwork->latitude .',' .$this->mobileArtwork->longitude) : NULL; },
            ],
            [
                "name" => 'selector_number',
                "doc" => "The code that can be entered in our audioguides to learn more about this work",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->mobileArtwork->selector_number ?? null; },
            ],
            // EOF TODO Mobile\Artwork
            [
                "name" => 'artist_id',
                "doc" => "Unique identifier of the preferred artist/culture associated with this work",
                "type" => "integer",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artist->citi_id ?? null; },
            ],
            [
                "name" => 'alt_artist_ids',
                "doc" => "Unique identifiers of the non-preferred artists/cultures associated with this work",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->altArtists->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'artist_ids',
                "doc" => "Unique identifier of all artist/cultures associated with this work",
                "type" => "integer",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artists->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'category_ids',
                "doc" => "Unique identifiers of the categories this work is a part of",
                "type" => "array",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->categories->pluck('lake_uid')->all(); },
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
                // @DEPRECATE since the list of dates isn't useful without their qualifiers
                "name" => 'date_dates',
                "doc" => "List of all the dates associated with this work. Includes creation dates, and may also include publication dates for works on paper, exhibition dates for provenance, found dates for archaeological finds, etc.",
                "type" => "array",
                'elasticsearch_type' => 'date',
                "value" => function() { return []; },
            ],
            [
                "name" => 'artwork_catalogue_ids',
                "doc" => "This list represents all the catalogues this work is included in. This isn't an exhaustive list of publications where the work has been mentioned. For that, see `publication_history`.",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->artworkCatalogues->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'term_titles',
                "doc" => "The names of the taxonomy tags for this work",
                "type" => "array",
                "elasticsearch" => [
                    "default" => true,
                ],
                "value" => function() { return $this->terms->pluck('title')->all(); },
            ],
            [
                "name" => 'style_id',
                "doc" => "Unique identifier of the preferred style term for this work",
                "type" => "string",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->style->lake_uid ?? null; },
            ],
            [
                "name" => 'alt_style_ids',
                "doc" => "Unique identifiers of all other non-preferred style terms for this work",
                "type" => "array",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->altStyles->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'style_ids',
                "doc" => "Unique identifiers of all style terms for this work",
                "type" => "array",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->styles->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'style_titles',
                "doc" => "The names of all style terms related to this artwork",
                "type" => "array",
                "value" => function() { return $this->styles->pluck('title')->all(); },
            ],
            [
                "name" => 'classification_id',
                "doc" => "Unique identifier of the preferred classification term for this work",
                "type" => "string",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->classification->lake_uid ?? null; },
            ],
            [
                "name" => 'alt_classification_ids',
                "doc" => "Unique identifiers of all other non-preferred classification terms for this work",
                "type" => "array",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->altClassifications->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'classification_ids',
                "doc" => "Unique identifiers of all classification terms for this work",
                "type" => "array",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->classifications->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'classification_titles',
                "doc" => "The names of all classification terms related to this artwork",
                "type" => "array",
                "value" => function() { return $this->classifications->pluck('title')->all(); },
            ],
            [
                "name" => 'subject_id',
                "doc" => "Unique identifier of the preferred subject term for this work",
                "type" => "string",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->subject->lake_uid ?? null; },
            ],
            [
                "name" => 'alt_subject_ids',
                "doc" => "Unique identifiers of all other non-preferred subject terms for this work",
                "type" => "array",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->altSubjects->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'subject_ids',
                "doc" => "Unique identifiers of all subject terms for this work",
                "type" => "array",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->subjects->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'subject_titles',
                "doc" => "The names of all subject terms related to this artwork",
                "type" => "array",
                "value" => function() { return $this->subjects->pluck('title')->all(); },
            ],
            [
                "name" => 'material_id',
                "doc" => "Unique identifier of the preferred material term for this work",
                "type" => "string",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->material->lake_uid ?? null; },
            ],
            [
                "name" => 'alt_material_ids',
                "doc" => "Unique identifiers of all other non-preferred material terms for this work",
                "type" => "array",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->altMaterials->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'material_ids',
                "doc" => "Unique identifiers of all material terms for this work",
                "type" => "array",
                "elasticsearch_type" => "keyword",
                "value" => function() { return $this->materials->pluck('lake_uid')->all(); },
            ],
            [
                "name" => 'material_titles',
                "doc" => "The names of all material terms related to this artwork",
                "type" => "array",
                "value" => function() { return $this->materials->pluck('title')->all(); },
            ],

            // This field is added to the Elasticsearch schema manually via elasticsearchMappingFields
            [
                "name" => 'color',
                "doc" => "Dominant color of this artwork in HSL",
                "type" => "object",
                "value" => function() { return $this->image->metadata->color ?? null; },
            ],
            [
                "name" => 'image_id',
                "doc" => "Unique identifier of the preferred image to use to represent this work",
                "type" => "uuid",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image->lake_guid ?? null; },
            ],
            [
                "name" => 'alt_image_ids',
                "doc" => "Unique identifiers of all non-preferred images of this work.",
                "type" => "array",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->altImages->pluck('lake_guid')->all(); },
            ],
            [
                "name" => 'document_ids',
                "doc" => "Unique identifiers of assets that serve as documentation for this artwork",
                "type" => "array",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->documents->pluck('lake_guid') ?? null; },
            ],
            [
                "name" => 'sound_ids',
                "doc" => "Unique identifiers of the audio about this work",
                "type" => "uuid",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->sounds->pluck('lake_guid') ?? null; },
            ],
            [
                "name" => 'video_ids',
                "doc" => "Unique identifiers of the videos about this work",
                "type" => "uuid",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->videos->pluck('lake_guid') ?? null; },
            ],
            [
                "name" => 'text_ids',
                "doc" => "Unique identifiers of the texts about this work",
                "type" => "uuid",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->texts->pluck('lake_guid') ?? null; },
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
                'elasticsearch_type' => 'integer',
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

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            [
                "name" => 'artist_titles',
                "doc" => "Names of the artists this artwork is a part of",
                "type" => "array",
                // Previously defined in StaticArchive/Site
                "elasticsearch" => [
                    "default" => true,
                    // This is controllable via .env so we can tweak it without pushing to prod
                    "boost" => (float) ( env('SEARCH_BOOST_ARTIST_TITLES') ?: 2 ),
                ],
                "value" => function() { return $this->artists->pluck('title')->all(); },
            ],
            [
                "name" => 'category_titles',
                "doc" => "Names of the categories this artwork is a part of",
                "type" => "array",
                "elasticsearch" => [
                    "default" => true,
                ],
                "value" => function() { return $this->categories->pluck('title')->all(); },
            ],
            [
                "name" => 'part_titles',
                "doc" => "Names of the artworks that make up this work",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->parts->pluck('title')->all(); },
            ],
            [
                "name" => 'set_titles',
                "doc" => "Names of the sets this work is a part of",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->sets->pluck('title')->all(); },
            ],
            // TODO: Move these to Mobile\Artwork
            [
                "name" => 'tour_titles',
                "doc" => "Names of the tours this work is a part of",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->mobileArtwork && $this->mobileArtwork->tours ? $this->mobileArtwork->tours->pluck('title')->all() ?? null : null; },
            ],
            [
                "name" => 'section_titles',
                "doc" => "Names of the digital publication chapters this work is included in",
                "type" => "array",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->sections->pluck('title')->all(); },
            ],

        ];

    }

    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return [
            'color' => [
                'type' => 'object',
                'properties' => [
                    'population' => [ 'type' => 'integer' ],
                    'percentage' => [ 'type' => 'float' ],
                    'h' => [ 'type' => 'integer' ],
                    's' => [ 'type' => 'integer' ],
                    'l' => [ 'type' => 'integer' ],
                ]
            ],
        ];

    }


    public function searchableImage()
    {

        return $this->image->iiif_url ?? null;

    }


    /**
     * Get the subresources for the resource.
     *
     * @return array
     */
    public function subresources()
    {

        return ['artists', 'categories', 'images', 'parts', 'sets'];

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

    /**
     * Generate documentation for boosted endpoints
     *
     * @return string
     */
    public function docBoostedDescription()
    {

        $endpoint = app('Resources')->getEndpointForModel(get_called_class());

        return $this->traitDocBoostedDescription() ." This is a subset of the `" .$endpoint ."/` endpoint that represents approximately 400 of our most well-known artworks as featured in three important catalogs: Paintings at the Art Institute of Chicago: Highlights of the Collection, The Essential Guide, and Master Paintings in the Art Institute of Chicago. This can be used to get a shorter list of " .$endpoint ." that will have most of its metadata filled out for testing purposes.";

    }

}
