<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Represents a person or organization. In the API, this includes artists and venues.
 */
class Agent extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';

    protected $casts = [
        'alt_titles' => 'array',
    ];

    protected $touches = [
        'createdArtworks',
    ];

    public function agentType()
    {

        return $this->belongsTo('App\Models\Collections\AgentType');

    }

    public function createdArtworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_artist');

    }

    public function exhibitions()
    {

        return $this->belongsToMany('App\Models\Collections\Exhibition');

    }

    public function sites()
    {

        return $this->belongsToMany('App\Models\StaticArchive\Site', 'agent_site', 'agent_citi_id');

    }

    /**
     * Scope a query to only include agents that created an artwork.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtists($query)
    {

        return $query->whereHas('createdArtworks');

    }

    /**
     * Scope a search to only include agents that created an artwork.
     *
     * @return array
     */
    public static function searchScopeArtists()
    {

        return [
            'exists' => [
                'field' => 'artwork_ids'
            ]
        ];

    }

    /**
     * Scope a query to only include agents that have hosted an exhibition.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVenues($query)
    {

        return $query->whereHas('exhibitions');

    }

    /**
     * Get the IDs representing our essential artists from the database.
     *
     * These are artists that are included the Artwork::boostedIds list, along with the top
     * 100 viewed artists on our website in 2017.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function boostedIds() {

        return [
            100304,100363,100581,101310,102174,102445,103575,104036,104141,104542,
            105100,105112,107195,108592,108780,10930,112971,11328,114412,114512,114644,
            114672,11482,11782,135,1396,14096,14830,14911,15415,15615,15965,16367,16414,
            16578,17463,17492,17549,18851,19079,20464,20528,20772,2137,21570,21775,22528,
            23759,24282,24418,24535,24742,24885,24979,25418,25497,2601,26086,26388,27538,
            27657,28036,28375,29156,29840,29878,29882,29992,30074,30142,30183,30184,
            30317,30393,30703,30710,30723,31257,31299,31309,31435,31492,31706,31712,
            31814,32048,32671,32803,33007,33089,33229,33320,33376,33442,33473,33499,
            33571,33591,33637,33672,33692,33735,33739,33741,33838,33841,33849,33858,
            33885,33890,33894,33909,33968,34007,34023,34028,34033,34035,34049,34123,
            34147,34155,34225,34230,34263,34279,34314,34316,34368,34394,34395,34418,
            34437,34470,34544,34559,34563,34579,34611,34643,34743,34747,34761,34772,
            34853,34919,34922,34946,34954,34956,34965,34988,34996,35059,35061,35139,
            35142,35162,35188,35235,35237,35260,35282,35363,35425,35429,35480,35577,
            35594,35670,35729,35801,35809,35824,35834,35838,35850,35854,36005,36059,
            36062,36095,36138,36197,36198,36206,36226,36253,36259,36290,36326,36336,
            36350,36351,36397,36407,36418,36457,36467,36472,36482,36487,36507,36540,
            36613,36624,36631,36716,36782,36809,36845,36875,36881,36890,36972,36977,
            37001,37043,37048,37052,37097,37214,37219,37236,37275,37279,37343,37362,
            37363,37378,37410,37451,37458,37541,3829,38474,40422,40426,40482,40490,
            40497,40500,40543,40545,40561,40583,40608,40610,40614,40615,40669,40694,
            40769,40771,40810,40857,40869,40895,41039,41188,41354,41483,41499,41673,
            42134,42269,42281,42406,42408,42434,42445,42645,42671,42675,43370,43520,
            43760,43762,43765,43768,44014,44159,44224,44584,44708,44741,44812,44904,
            47905,47950,47966,49010,49196,50495,50668,50920,50993,51349,5383,54234,
            54721,54948,55016,55184,55343,55958,56447,57216,57231,57444,57509,57563,
            57829,58479,59979,60337,61495,61535,61657,6512,6656,69431,7268,7353,73847,
            77459,81537,81689,8363,8364,86099,91529,9865
        ];

    }

    public function isBoosted()
    {

        return in_array( $this->getKey(), static::boostedIds() );

    }

    /**
     * Get the models representing our essential artists from the database.
     *
     * These are artists that are included the Artwork::boostedIds list, along with the top
     * 100 viewed artists on our website in 2017.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function boosted()
    {

        return (new static)->newQuery()->whereKey( static::boostedIds() );

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'sort_title',
                "doc" => "Sortable name for this agent, typically with last name first.",
                "type" => "string",
                "elasticsearch_type" => 'text',
                "value" => function() { return $this->sort_title; },
            ],
            [
                "name" => 'alt_titles',
                "doc" => "Altername names for this agent",
                "type" => "array",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->alt_titles; },
            ],
            [
                "name" => 'birth_date',
                "doc" => "The year this agent was born",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->birth_date; },
            ],
            [
                "name" => 'birth_place',
                "doc" => "Name of the place this agent was born",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->birth_place; },
            ],
            [
                "name" => 'death_date',
                "doc" => "The year this agent died",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->death_date; },
            ],
            [
                "name" => 'death_place',
                "doc" => "Name of the place this agent died",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->death_place; },
            ],
            [
                "name" => 'ulan_uri',
                "doc" => "Unique identifier of this agent in Getty's ULAN",
                "type" => "uri",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->ulan_uri; },
            ],
            [
                "name" => 'is_licensing_restricted',
                "doc" => "Whether the use of the images of works by this artist are restricted by licensing",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->licensing_restricted; },
            ],
            [
                "name" => 'is_artist',
                "doc" => "Whether the agent is an artist. Soley based on whether the agent is listed as an artist for an artwork record.",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return $this->createdArtworks()->count() > 0; },
            ],
            [
                "name" => 'agent_type_title',
                "doc" => "Name of the type of agent, e.g. individual, fund, school, organization, etc.",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->agentType->title ?? null; },
            ],
            [
                "name" => 'agent_type_id',
                "doc" => "Unique identifier of the type of agent, e.g. individual, fund, school, organization, etc.",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->agentType->citi_id ?? null; },
            ],
            [
                "name" => 'artwork_ids',
                "doc" => "Unique identifiers of the works this artist created.",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->createdArtworks->pluck('citi_id'); },
            ],
            [
                "name" => 'site_ids',
                "doc" => "Unique identifiers of the microsites this exhibition is a part of",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->sites->pluck('site_id')->all(); },
            ],
        ];

    }

    /**
     * Add suggest fields and values. By default, only boosted works are added to the autocomplete.
     * Agents are a special case, wherein multiple names are common.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/search-suggesters.html
     * @link https://www.elastic.co/blog/you-complete-me (obsolete)
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.0/breaking_50_suggester.html
     *
     * @return array
     */
    public function getSuggestSearchFields()
    {

        if ($this->createdArtworks()->count() < 1) {
            return [];
        }

        $withTitles = [
            'input' => array_merge(
                [
                    $this->title,
                    $this->sort_title,
                ],
                $this->alt_titles ?? []
            ),
            // Boosts agents higher than unweighted items
            'weight' => 2,
        ];

        $fields = [];

        if( $this->isBoosted() )
        {
            // Boosts popular agents higher than normal agents
            // Cascades to `suggest_autocomplete_all`
            $withTitles['weight'] = 3;

            $fields['suggest_autocomplete_boosted'] = $withTitles;
        }

        // For autocomplete v2
        $withTitles['contexts'] = [
            'groupings' => [
                'title',
            ]
        ];
        $fields['suggest_autocomplete_all'] = $withTitles;

        return $fields;

    }

}
