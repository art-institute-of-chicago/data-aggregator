<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\HasRelationships;

use Illuminate\Support\Str;

/**
 * Represents a work of art in our collections.
 */
class Artwork extends CollectionsModel
{
    use HasRelationships;
    use ElasticSearchable;

    protected $casts = [
        'alt_titles' => 'array',
        'dimensions_detail' => 'array',
        'is_public_domain' => 'boolean',
        'is_zoomable' => 'boolean',
        'is_on_view' => 'boolean',
        'linked_art_json' => 'object',
    ];

    protected $with = [
        'artistPivots',
        'artists',
        'artworkType',
        'categories',
        'departments',
        'themes',
        'dates',
        'terms',
        'termPivots',
        'gallery',
        'images',
        'imagePivots', // improves, but why?
        'assets',
        'assetPivots', // improves, but why?
        'mobileArtwork',
        'sections',
        'sites',
        'placePivots',
        'places',
    ];

    /**
     * Scope a query to only include permanent collection items.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtworks($query)
    {
        return $query->whereNull('fiscal_year_deaccession');
    }

    public static function searchScopeArtworks()
    {
        return [
            'bool' => [
                'must_not' => [
                    'exists' => [
                        'field' => 'fiscal_year_deaccession'
                    ]
                ],
            ],
        ];
    }

    /**
     * Scope a query to only include deaccessioned artworks.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDeaccessions($query)
    {
        return $query->whereNotNull('fiscal_year_deaccession');
    }

    public static function searchScopeDeaccessions()
    {
        return [
            'exists' => [
                'field' => 'fiscal_year_deaccession'
            ]
        ];
    }
    public function thumbnail()
    {
        // TODO: Change this to be polymorphic + use its own table?
        return $this->images()->isPreferred();
    }

    public function artistPivots()
    {
        return $this->hasMany('App\Models\Collections\ArtworkArtistPivot');
    }

    public function artists()
    {
        return $this->belongsToMany('App\Models\Collections\Agent', 'artwork_artist')
            ->using('App\Models\Collections\ArtworkArtistPivot')
            ->withPivot('is_preferred');
    }

    public function getArtistAttribute()
    {
        return $this->preferred('artist');
    }

    public function getAltArtistsAttribute()
    {
        return $this->alts('artist');
    }

    public function artworkType()
    {
        return $this->belongsTo('App\Models\Collections\ArtworkType');
    }

    public function categories()
    {
        $relation = $this->belongsToMany('App\Models\Collections\Category');

        // TODO: Probably also filter this out of the database dumps?
        if (isset($this->fiscal_year_deaccession)) {
            return $relation->where('subtype', '!=', CategoryTerm::DEPARTMENT);
        }

        return $relation;
    }

    public function departments()
    {

        // We assumed this was a many-to-one relationship; this is a patch. Put `null` first:
        // https://stackoverflow.com/questions/2051602/mysql-orderby-a-number-nulls-last
        // This doesn't work great b/c the ids are alphanumeric, not numeric
        // https://stackoverflow.com/questions/153633/natural-sort-in-mysql
        return $this->categories()->departments()->orderBy('parent_id', 'asc')->orderBy('id', 'asc');
    }

    public function themes()
    {
        return $this->categories()->themes();
    }

    public function dateQualifier()
    {
        return $this->belongsTo('App\Models\Collections\ArtworkDateQualifier', 'artwork_date_qualifier_id');
    }

    public function dates()
    {
        return $this->hasMany('App\Models\Collections\ArtworkDate');
    }

    public function terms()
    {
        return $this->belongsToMany('App\Models\Collections\Term')->withPivot('is_preferred');
    }

    public function termPivots()
    {
        return $this->hasMany('App\Models\Collections\ArtworkTerm');
    }

    public function getStylesAttribute()
    {
        return $this->relatedResources('term', CategoryTerm::STYLE, 'subtype');
    }

    public function getStyleAttribute()
    {
        return $this->preferred('term', CategoryTerm::STYLE, 'subtype');
    }

    public function getAltStylesAttribute()
    {
        return $this->alts('term', CategoryTerm::STYLE, 'subtype');
    }

    public function getClassificationsAttribute()
    {
        return $this->relatedResources('term', CategoryTerm::CLASSIFICATION, 'subtype');
    }

    public function getClassificationAttribute()
    {
        return $this->preferred('term', CategoryTerm::CLASSIFICATION, 'subtype');
    }

    public function getAltClassificationsAttribute()
    {
        return $this->alts('term', CategoryTerm::CLASSIFICATION, 'subtype');
    }

    public function getSubjectsAttribute()
    {
        return $this->relatedResources('term', CategoryTerm::SUBJECT, 'subtype');
    }

    public function getSubjectAttribute()
    {
        return $this->preferred('term', CategoryTerm::SUBJECT, 'subtype');
    }

    public function getAltSubjectsAttribute()
    {
        return $this->alts('term', CategoryTerm::SUBJECT, 'subtype');
    }

    public function getMaterialsAttribute()
    {
        return $this->relatedResources('term', CategoryTerm::MATERIAL, 'subtype');
    }

    public function getMaterialAttribute()
    {
        return $this->preferred('term', CategoryTerm::MATERIAL, 'subtype');
    }

    public function getAltMaterialsAttribute()
    {
        return $this->alts('term', CategoryTerm::MATERIAL, 'subtype');
    }

    public function getTechniquesAttribute()
    {
        return $this->relatedResources('term', CategoryTerm::TECHNIQUE, 'subtype');
    }

    public function getTechniqueAttribute()
    {
        return $this->preferred('term', CategoryTerm::TECHNIQUE, 'subtype');
    }

    public function getAltTechniquesAttribute()
    {
        return $this->alts('term', CategoryTerm::TECHNIQUE, 'subtype');
    }

    public function gallery()
    {
        return $this->belongsTo('App\Models\Collections\Gallery');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Collections\Image', 'artwork_asset', 'artwork_id', 'asset_id')
            ->withPivot('is_preferred')
            ->withPivot('is_doc')
            ->wherePivot('is_doc', '=', false);
    }

    public function imagePivots()
    {
        return $this->hasMany('App\Models\Collections\ArtworkImagePivot');
    }

    public function getImageAttribute()
    {
        return $this->preferred('image');
    }

    public function getAltImagesAttribute()
    {
        return $this->alts('image');
    }

    public function assets()
    {
        return $this->belongsToMany('App\Models\Collections\Asset')->withPivot('is_doc');
    }

    public function assetPivots()
    {
        return $this->hasMany('App\Models\Collections\ArtworkAssetPivot');
    }

    public function documents()
    {
        return $this->belongsToMany('App\Models\Collections\Asset')->withPivot('is_doc')->wherePivot('is_doc', '=', true);
    }

    public function sounds()
    {
        return $this->relatedResources('asset', Asset::SOUND);
    }

    public function videos()
    {
        return $this->relatedResources('asset', Asset::VIDEO);
    }

    public function texts()
    {
        return $this->relatedResources('asset', Asset::TEXT);
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
            ->withPivot('is_preferred');
    }

    public function webArtwork()
    {
        return $this->hasOne('App\Models\Web\Artwork');
    }

    // Meh, we'll leave out preferred & alternative places for now

    public function getAltTextAttribute($value)
    {
        // If CITI provided `visual_description`, return that
        if (isset($value)) {
            return $value;
        }

        $ret = 'A';

        if ($this->classification_title) {
            if (Str::endsWith($this->classification_title, 'ing')) {
                if (preg_match('/^[aeiouAEIOU]/', $this->classification_title, $matches)) {
                    $ret .= 'n';
                }

                $ret .= " {$this->classification_title}";
            } else {
                $ret .= " work of {$this->classification_title}";
            }
        } else {
            $ret .= ' work';
        }

        if ($this->material_titles) {
            $ret .= ' made of ' . summation($this->material_titles);
        } elseif ($this->medium_display) {
            $ret .= ' made of ' . mb_strtolower($this->medium_display);
        }

        $ret .= '.';

        if ($this->subject_titles) {
            $ret .= ' The work includes ' . summation($this->subject_titles) . '.';
        }

        return $ret;
    }

    /**
     * Get the models representing our essential artworks from the database.
     *
     * Artworks from three different catalogues: Paintings at the Art Institute of Chicago: Highlights of the Collection,
     * The Essential Guide, and Master Paintings in the Art Institute of Chicago.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function boostedIds()
    {
        return array_merge(
            [
                185651, 183077, 151358, 99539, 189595, 187528, 102611, 111401, 91620, 18757, 51185, 55249, 14968, 65290, 75644,
                106538, 59787, 103347, 104094, 100829, 76571, 154237, 154238, 149776, 120154, 44018, 56905, 102295, 105105, 184672,
                111442, 25865, 72801, 97916, 190558, 36161, 15401, 69780, 64724, 185905, 65916, 40619, 151371, 63178, 104031,
                46327, 6565, 83905, 111628, 117266, 56682, 156538, 196323, 71829, 105203, 131541, 192890, 104043, 189289, 189290,
                144272, 190224, 102963, 191197, 188540, 188845, 64339, 159136, 70207, 185963, 70003, 35376, 42566, 88724, 43060,
                76279, 183277, 73216, 185180, 111380, 56731, 9512, 11272, 127644, 185222, 88977, 89856, 24645, 153244, 24548,
                21023, 13853, 34286, 49195, 86340, 142526, 58540, 69109, 99766, 16964, 73417, 79379, 76244, 83642, 157156,
                100472, 4884, 147003, 86385, 146991, 186049, 71396, 35198, 97402, 68823, 102234, 184362, 146988, 93345, 191371,
                47149, 90583, 107069, 110634, 100250, 160222, 147513, 146989, 76054, 90443, 187165, 157160, 159824, 192689, 137125,
                148306, 140645, 186392, 182728, 154232, 184193, 184186, 181091, 160226, 181774, 189207, 184095, 181145, 34116, 156442,
                189715, 57819, 126981, 147508, 6596, 50330, 68769, 186047, 103943, 111400, 107300, 148412, 43714, 46230, 50909,
                25332, 52560, 16231, 15468, 16169, 184324, 16327, 184371, 23972, 25853, 199854, 112092, 44741, 87479, 84709,
                27310, 73413, 95998, 11434, 5848, 60755, 16488, 4788, 93900, 57051, 27307, 16362, 102591, 111317, 110663,
                144969, 4758, 4796, 44892, 14598, 81512, 11723, 20684, 81558, 14655, 11320, 110507, 14572, 27992, 16487,
                80607, 19339, 28560, 64818, 61128, 60812, 111436, 28067, 16568, 87045, 109330, 66039, 79307, 111060, 9503,
                8624, 8991, 80062, 185766, 30839, 27987, 91194, 144361, 2816, 109819, 153701, 109275, 27984, 7124, 111654,
                118746, 37761, 185760, 72728, 5357, 61608, 185184, 84241, 151424, 59426, 34181, 111642, 20509, 38930, 145681,
                63554, 157056, 66683, 66434, 119454, 55384, 70739, 50157, 100079, 50148, 13720, 100089, 87163, 63234, 188844,
                191454, 117271, 160201, 187155, 110881, 23506, 105073, 60031, 90536, 20432, 103887, 76295, 102131, 52736, 50276,
                76779, 61603, 111164, 160144, 18709, 16776, 76395, 72726, 70202, 23684, 135430, 83889, 111810, 131385, 122054,
                90300, 99602, 149681, 85533, 189600, 36132, 70443, 80479, 189775, 52679, 86421, 49691, 150739, 180298, 185619,
                155969, 64884, 109686, 16298, 4575, 4081, 105466, 59847, 62042, 80084, 146953, 869, 43145, 23333, 111610,
                111559, 4773, 4428, 16499, 14574, 20579, 16571, 14591, 16146, 62371, 154235, 109926, 49702, 150054, 55706,
                90048, 30709, 146701, 81564, 28849, 111377, 97910, 64729, 8958, 31285, 87643, 119521, 76240, 109780, 79600,
                23700, 65868, 93811, 61428, 64276, 111617, 117188, 49714, 125660, 2189, 146905, 89403, 127859, 88793, 79507,
                92975, 234781, 76816, 76869, 210511, 193664, 210482, 16551, 11393, 7021, 207293, 156474, 234972, 49686, 105800,
                118661, 217201, 191556, 198809, 34299, 15563, 220272, 229354, 229351, 229406, 223309, 129884, 234004, 227420, 24836,
                234433, 218612, 199002, 229510, 189932, 230189, 225016, 221885, 229866, 109439, 869, 4081, 4773, 16146, 23333, 23700,
                30709, 31285, 43145, 49702, 62042, 62371, 76240, 79600, 81564, 105466, 109926, 111377, 111559, 119521, 146701, 146953,
                150054, 238749, 100858, 229393, 151363, 53001, 189807, 9010, 220179, 37368,
            ],
            self::getFeaturedIds()
        );
    }

    /**
     * Get ids for artworks that must always be returned in a specific order.
     * This returns an array of arrays of ids. The request is that the artworks
     * always stay within their buckets, but the buckets do not overlap.
     *
     * @TODO: Make this controllable via the CMS
     *
     * @return array
     */
    public static function getFeaturedIds()
    {
        return [
            129884, // Starry Night and the Astronauts
            28560, // The Bedroom
            21023, // Buddha Shakyamuni Seated in Meditation
            137125, // Many Mansions

            229393, // Untitled
            20684, // Paris Street
            27992, // La Grande Jatte
            151363, // The Weaver

            86385, // City Landscape
            75644, // Coronation Stone
            117266, // Nightlife
            8633, // Hero Construction

            111628, // Nighthawks
            102611, // Veranda Post of Enthroned
            24306, // Blue and Green Music
            79307, // Bathers by a River

            28067, // The Old Guitarist
            24645, // Under the Wave off Kanagawa
            87479, // The Assumption of the Virgin
            64818, // Stacks of Wheat
        ];
    }

    /**
     * Provides a bucketed rank number for this artwork. Only featured artworks
     * are given a rank number. Rank is noncontiguous.
     *
     * @return int
     */
    public function getBoostRank()
    {
        $ids = $this->getFeaturedIds();

        if (!in_array($this->getKey(), $ids)) {
            return null;
        }

        // Get index of this artwork in the array
        $rank = array_flip($ids)[$this->getKey()];

        // Subdivide them into buckets of 4
        $rank = (intdiv($rank, 4) + 1) * ($rank + 1);

        return $rank;
    }

    public function isBoosted()
    {
        return in_array($this->getKey(), static::boostedIds());
    }

    /**
     * Apply score adjustments to the entire query using `function_score`.
     *
     * @return array
     */
    public static function searchFunctionScoreArtworks()
    {
        return [
            'all' => [

                // Make pageviews influence score
                [
                    'filter' => [
                        'exists' => [
                            'field' => 'pageviews',
                        ],
                    ],
                    'field_value_factor' => [
                        'field' => 'pageviews',
                        'modifier' => 'log1p',
                        'factor' => 1.2,
                        'missing' => 1,
                    ],
                ],

                // Make pageviews_recent influence score
                [
                    'filter' => [
                        'exists' => [
                            'field' => 'pageviews_recent',
                        ],
                    ],
                    'field_value_factor' => [
                        'field' => 'pageviews_recent',
                        'modifier' => 'log1p',
                        'factor' => 1.5,
                        'missing' => 1,
                    ],
                ],

            ],
            'except_full_text' => [

                // Make `boost_rank` influence score
                [
                    'filter' => [
                        'exists' => [
                            'field' => 'boost_rank',
                        ],
                    ],
                    'field_value_factor' => [
                        'field' => 'boost_rank',
                        'modifier' => 'reciprocal',
                        'factor' => 1 / 2048,
                        'missing' => 1,
                    ],
                ],

            ],

        ];
    }

    /**
     * Add relevancy tweaks to artworks.
     *
     * @return array
     */
    public static function searchBoostArtworks()
    {
        return [
            // Boost anything that has an image
            'exists' => [
                'field' => 'image_id',
            ],
        ];
    }

    public function searchableImage()
    {
        return $this->image->iiif_url ?? null;
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
     * For this resource, add this to the full documentation.
     *
     * @return string
     */
    public function docExtra()
    {
        $endpointAsCopyText = $this->_endpointAsCopyText();

        // Title
        $doc = '##### `GET ' . $this->_endpointPath(['extraPath' => '{id}/manifest[.json]']) . "`\n\n";

        $doc .= "A representation of this artwork in the IIIF Presentation API format.\n\n";

        if ($id = $this->exampleId()) {
            $doc .= $this->docExampleOutput(['id' => $id, 'extraPath' => 'manifest.json', 'extraAtEnd' => true]);
        }

        return $doc;
    }
}
