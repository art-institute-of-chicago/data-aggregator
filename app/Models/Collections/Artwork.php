<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

class Artwork extends CollectionsModel
{

    use ElasticSearchable;

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

        return $this->belongsToMany('App\Models\Collections\Image');

    }

    public function mobileArtwork()
    {

        return $this->hasOne('App\Models\Mobile\Artwork');

    }

    public function mobileSounds()
    {

        return $this->belongsToMany('App\Models\Mobile\Sound', 'artwork_mobile_app_sound', 'artwork_citi_id', 'mobile_app_sound_mobile_id');

    }

    public function tourStops()
    {

        return $this->hasMany('App\Models\Mobile\TourStop');

    }

    public function tours()
    {

        return $this->belongsToMany('App\Models\Mobile\Tour', 'tour_stops');

    }

    public function publications()
    {

        return $this->belongsToMany('App\Models\Dsc\Publication', 'works_of_art');

    }

    public function getFillFieldsFrom($source, $fake = true)
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
            'description' => $fake ? 'fake ' .$this->faker->paragraphs(5, true) : null,
            'publishing_verification_level' => $fake ? 'fake ' .$this->faker->randomElement(['Web Basic', 'Web Cataloged', 'Web Everything']) : null,
            'is_public_domain' => $fake ? $this->faker->boolean : null,
            'copyright_notice' => $source->copyright ? reset($source->copyright) : null,
            'place_of_origin' => $fake ? 'fake ' .$this->faker->country : null,
            'collection_status' => $fake ? 'fake ' .$this->faker->randomElement(['Permanent Collection', 'Long-term Loan']) : null,
            'department_citi_id' => $source->department_id,
            //'object_type_citi_id' => ,
            //'gallery_citi_id' => ,
            'source_created_at' => strtotime($source->created_at),
            'source_modified_at' => strtotime($source->modified_at),
            'source_indexed_at' => strtotime($source->indexed_at),
        ];

    }

    public function attachFrom($source, $fake = true)
    {

        if ($source->creator_id)
        {

            Artist::findOrCreate($source->creator_id);
            $this->artists()->attach($source->creator_id);

        }

        if ($source->image_guid)
        {
            $image = Image::findOrCreate($source->image_guid);
            $image->preferred = true;
            $this->images()->save($image);
        }


        if ($source->department_id)
        {

            $department = Department::findOrCreate($source->department_id);
            $this->department()->associate($department);

        }

        if ($source->category_ids)
        {
            foreach ($source->category_ids as $id)
            {

                $cat = Category::where('citi_id', $id)->first();
                if ($cat)
                {

                    $this->categories()->attach($cat->citi_id);

                }

            }

        }
        // $source->document_guids

        // @TODO Replace with real endpoints when they become available
        if( $fake ) {
            $this->seedCopyrightRepresentatives();
            $this->seedCommittees();
            $this->seedTerms();
            $this->seedDates();
            $this->seedCatalogues();
            $this->seedImages();
            //$this->seedParts();
        }

        // update artworks with gallery id and object type id

        return $this;

    }

    public function seedCopyrightRepresentatives()
    {

        $agentIds = CopyrightRepresentative::all()->pluck('citi_id')->all();

        $ids = [];

        for ($i = 0; $i < rand(2,8); $i++) {

            $id = $agentIds[array_rand($agentIds)];

            if (!in_array($id, $ids)) {
                $this->copyrightRepresentatives()->attach($id);
                $ids[] = $id;
            }

        }

        return $this;

    }

    public function seedCommittees()
    {

        for ($i = 0; $i < rand(2,8); $i++) {

            $committee = factory(ArtworkCommittee::class)->make([
                'artwork_citi_id' => $this->citi_id,
            ]);

            $this->committees()->save($committee);

        }

        return $this;

    }

    public function seedTerms()
    {

        for ($i = 0; $i < rand(2,8); $i++) {

            $term = factory(ArtworkTerm::class)->make([
                'artwork_citi_id' => $this->citi_id,
            ]);

            $this->terms()->save($term);

        }

        return $this;

    }

    public function seedDates()
    {

        $hasPreferred = false;

        for ($i = 0; $i < rand(2,8); $i++) {

            $preferred = $hasPreferred ? false : $this->faker->boolean;

            $this->dates()->create([
                'date' => $this->faker->dateTimeAD,
                'qualifier' => ucfirst($this->faker->word) .' date',
                'preferred' => $preferred,
            ]);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

        return $this;

    }

    public function seedCatalogues()
    {

        $hasPreferred = false;

        for ($i = 0; $i < rand(2,8); $i++) {

            $preferred = $this->faker->boolean;

            $this->catalogues()->create([
                'preferred' => $hasPreferred ? false : $this->faker->boolean,
                'catalogue' => ucwords($this->faker->words(2, true)),
                'number' => $this->faker->randomNumber(3),
                'state_edition' => $this->faker->words(2, true),
            ]);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

        return $this;

    }

    public function seedImages()
    {

        $hasPreferred = false;

        for ($i = 0; $i < rand(2,4); $i++) {

            $preferred = $hasPreferred ? false : $this->faker->boolean;

            // TODO: Problem! What if the image depicts multiple artworks?
            // This architecture means it would have to be the preferred one for all of them!
            // Potentially consider specifying `preferred` column on the pivot table?
            // https://laravel.com/docs/5.4/eloquent-relationships#many-to-many
            $image = factory(\App\Models\Collections\Image::class)->make([
                'preferred' => $preferred,
            ]);
            $this->images()->save($image);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

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
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return array_merge(
            [
                'main_reference_number' => $this->main_id,
                'date_start' => $this->date_start,
                'date_end' => $this->date_end,
                'date_display' => $this->date_display,
                'description' => $this->description,
                'artist_display' => $this->artist_display,
                'department' => $this->department ? $this->department->title : NULL,
                'department_id' => $this->department_citi_id,
                'dimensions' => $this->dimensions,
                'medium' => $this->medium_display,
                'inscriptions' => $this->inscriptions,
                'object_type' => $this->objectType ? $this->objectType->title : NULL,
                'object_type_id' => $this->object_type_citi_id,
                'credit_line' => $this->credit_line,
                'publication_history' => $this->publication_history,
                'exhibition_history' => $this->exhibition_history,
                'provenance_text' => $this->provenance,
                'publishing_verification_level' => $this->publishing_verification_level,
                'is_public_domain' => (bool) $this->is_public_domain,
                'copyright_notice' => $this->copyright_notice,
                'place_of_origin' => $this->place_of_origin,
                'collection_status' => $this->collection_status,
                'gallery' => $this->gallery ? $this->gallery->title : '',
                'gallery_id' => $this->gallery_citi_id,
                'is_in_gallery' => $this->gallery_citi_id ? true : false,
            ],
            $this->transformMobileArtwork(),
            [
                'artist_ids' => $this->artists->pluck('citi_id')->all(),
                'category_ids' => $this->categories->pluck('citi_id')->all(),
                'copyright_representative_ids' => $this->copyrightRepresentatives->pluck('citi_id')->all(),
                'part_ids' => $this->parts->pluck('citi_id')->all(),
                'set_ids' => $this->sets->pluck('citi_id')->all(),
                'date_dates' => $this->dates()->pluck('date')->transform(function ($item, $key) {
                    return $item->toIso8601String();
                })->all(),
                'catalogue_titles' => $this->catalogues->pluck('catalogue')->all(),
                'committee_titles' => $this->committees->pluck('committee')->all(),
                'term_titles' => $this->terms->pluck('term')->all(),
                // TODO: Fix me! Using map callback?
                // 'image_urls' => $this->images->pluck('iiif_url')->all(),
                'publication_ids' => $this->publications->pluck('dsc_id')->all(),
                'tour_ids' => $this->tours->pluck('mobile_id')->all(),
            ]
        );

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
            'publication_titles' => $this->publications->pluck('title')->all(),
            'tour_titles' => $this->tours->pluck('title')->all(),

        ];

    }


    /**
     * Turn the relevant fields from the related mobile artwork model into a generic array
     *
     * @return array
     */
    protected function transformMobileArtwork()
    {

        if ($this->mobileArtwork) {

            return [

                'latitude' => $this->mobileArtwork->latitude,
                'longitude' => $this->mobileArtwork->longitude,
                'latlon' => $this->mobileArtwork->latitude .',' .$this->mobileArtwork->longitude,
                'is_highlighted_in_mobile' => (bool) $this->mobileArtwork->highlighted,
                'selector_number' => $this->mobileArtwork->selector_number,

            ];

        }

        return [];

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
                'publication_id' => [
                    'type' => 'integer',
                ],
                'publication_ids' => [
                    'type' => 'integer',
                ],
                'publication_titles' => [
                    'type' => 'text',
                ],
                'tour_ids' => [
                    'type' => 'integer',
                ],
                'tour_titles' => [
                    'type' => 'text',
                ],
            ];

    }

}
