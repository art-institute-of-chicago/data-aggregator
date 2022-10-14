<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * Represents a person or organization. In the API, this includes artists.
 */
class Agent extends CollectionsModel
{
    use ElasticSearchable;

    protected $casts = [
        'alt_titles' => 'array',
    ];

    protected $with = [
        // API-94: Passthrough `intro_text` into `description`
        'webArtist',
    ];

    protected $withCount = [
        // API-94, API-341: Speeds up `description` and filters in suggest fields
        'createdArtworks',
    ];

    protected $touches = [
        'createdArtworks',
    ];

    public function agentType()
    {
        return $this->belongsTo('App\Models\Collections\AgentType');
    }

    public function webArtist()
    {
        return $this->hasOne('App\Models\Web\Artist');
    }

    public function createdArtworks()
    {
        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_artist')->artworks();
    }

    /**
     * Scope a query to only include agents that created an artwork.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArtists($query)
    {
        // API-341: Force `SELECT count(*)` in subquery for speed
        return $query->whereHas('createdArtworks', null, '>', 0);
    }

    /**
     * Scope a search to only include agents that created an artwork.
     *
     * @return array
     */
    public static function searchScopeArtists()
    {
        return [
            'term' => [
                'is_artist' => true,
            ],
        ];
    }

    /**
     * Add relevancy tweaks to agents.
     *
     * @return array
     */
    public static function searchBoostAgents()
    {
        return [
            // Boost agents that are artists
            [
                'term' => [
                    'is_artist' => true,
                ],
            ],
            // Boost agents that have an image
            [
                'exists' => [
                    'field' => 'image_id',
                ],
            ],
            [
                'terms' => [
                    'id' => $this->boostedIds(),
                ]
            ]
        ];
    }
    /**
     * API-341: Needed for the mobile app. Our mobile app frontends query `api/v1/autocomplete`,
     * which uses the `suggest_autocomplete_boosted` field. Per the `filter` on that field in
     * `HasSuggestFields`, only boosted items will have that field. If we remove this method,
     * then we'd eventually have zero agents in `api/v1/autocomplete`.
     *
     * @link https://api.artic.edu/api/v1/autocomplete?q=monet&resources=artists
     */
    public function isBoosted()
    {
        return in_array($this->getKey(), static::boostedIds());
    }

    /**
     * Get the IDs representing our essential artists from the database.
     *
     * These are artists that are included the Artwork::boostedIds list,
     * along with the top 100 viewed artists on our website in 2017.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private static function boostedIds()
    {
        return [
            100304, 100363, 100581, 101310, 102174, 102445, 103575, 104036, 104141, 104542,
            105100, 105112, 107195, 108592, 108780, 10930, 112971, 11328, 114412, 114512, 114644,
            114672, 11482, 11782, 135, 1396, 14096, 14830, 14911, 15415, 15615, 15965, 16367, 16414,
            16578, 17463, 17492, 17549, 18851, 19079, 20464, 20528, 20772, 2137, 21570, 21775, 22528,
            23759, 24282, 24418, 24535, 24742, 24885, 24979, 25418, 25497, 2601, 26086, 26388, 27538,
            27657, 28036, 28375, 29156, 29840, 29878, 29882, 29992, 30074, 30142, 30183, 30184,
            30317, 30393, 30703, 30710, 30723, 31257, 31299, 31309, 31435, 31492, 31706, 31712,
            31814, 32048, 32671, 32803, 33007, 33089, 33229, 33320, 33376, 33442, 33473, 33499,
            33571, 33591, 33637, 33672, 33692, 33735, 33739, 33741, 33838, 33841, 33849, 33858,
            33885, 33890, 33894, 33909, 33968, 34007, 34023, 34028, 34033, 34035, 34049, 34123,
            34147, 34155, 34225, 34230, 34263, 34279, 34314, 34316, 34368, 34394, 34395, 34418,
            34437, 34470, 34544, 34559, 34563, 34579, 34611, 34643, 34743, 34747, 34761, 34772,
            34853, 34919, 34922, 34946, 34954, 34956, 34965, 34988, 34996, 35059, 35061, 35139,
            35142, 35162, 35188, 35235, 35237, 35260, 35282, 35363, 35425, 35429, 35480, 35577,
            35594, 35670, 35729, 35801, 35809, 35824, 35834, 35838, 35850, 35854, 36005, 36059,
            36062, 36095, 36138, 36197, 36198, 36206, 36226, 36253, 36259, 36290, 36326, 36336,
            36350, 36351, 36397, 36407, 36418, 36457, 36467, 36472, 36482, 36487, 36507, 36540,
            36613, 36624, 36631, 36716, 36782, 36809, 36845, 36875, 36881, 36890, 36972, 36977,
            37001, 37043, 37048, 37052, 37097, 37214, 37219, 37236, 37275, 37279, 37343, 37362,
            37363, 37378, 37410, 37451, 37458, 37541, 3829, 38474, 40422, 40426, 40482, 40490,
            40497, 40500, 40543, 40545, 40561, 40583, 40608, 40610, 40614, 40615, 40669, 40694,
            40769, 40771, 40810, 40857, 40869, 40895, 41039, 41188, 41354, 41483, 41499, 41673,
            42134, 42269, 42281, 42406, 42408, 42434, 42445, 42645, 42671, 42675, 43370, 43520,
            43760, 43762, 43765, 43768, 44014, 44159, 44224, 44584, 44708, 44741, 44812, 44904,
            47905, 47950, 47966, 49010, 49196, 50495, 50668, 50920, 50993, 51349, 5383, 54234,
            54721, 54948, 55016, 55184, 55343, 55958, 56447, 57216, 57231, 57444, 57509, 57563,
            57829, 58479, 59979, 60337, 61495, 61535, 61657, 6512, 6656, 69431, 7268, 7353, 73847,
            77459, 81537, 81689, 8363, 8364, 86099, 91529, 9865,
        ];
    }
}
