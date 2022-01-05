<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\StaticArchive\Site as SiteTransformer;
use App\Transformers\Outbound\Collections\AgentPlacePivot as AgentPlacePivotTransformer;

use App\Transformers\Outbound\HasSuggestFields;
use App\Transformers\Outbound\Collections\Traits\IsCC0;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class Agent extends BaseTransformer
{

    use IsCC0;
    use HasSuggestFields {
        getSuggestFields as traitGetSuggestFields;
    }

    protected $availableIncludes = [
        'sites',
        'place_pivots',
    ];

    public function includeSites($agent)
    {
        return $this->collection($agent->sites, new SiteTransformer(), false);
    }

    public function includePlacePivots($agent)
    {
        return $this->collection($agent->placePivots, new AgentPlacePivotTransformer(), false);
    }

    protected function getTitles()
    {
        $baseTitle = parent::getTitles();

        $baseTitle['title']['elasticsearch']['mapping'] = $this->getDefaultStringMapping([
            'analyzer' => 'name',
        ]);

        return array_merge($baseTitle, [
            'sort_title' => [
                'doc' => 'Sortable name for this agent, typically with last name first.',
                'type' => 'string',
                'elasticsearch' => [
                    'mapping' => [
                        'type' => 'text',
                        'analyzer' => 'name',
                    ],
                ],
            ],
            'alt_titles' => [
                'doc' => 'Alternate names for this agent',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,

                    'mapping' => [
                        'type' => 'text',
                        'analyzer' => 'name',
                    ],

                    // For better search experiences with Korean, Chinese and Japanese queries.
                    // See https://www.elastic.co/blog/how-to-search-ch-jp-kr-part-2
                    'fields' => [
                        'korean_field' => [
                            'analyzer' => 'openkoreantext-analyzer',
                            'type' => 'text',
                        ],
                        'japanese_field' => [
                            'analyzer' => 'kuromoji',
                            'type' => 'text'
                        ],
                        'chinese_field' => [
                            'analyzer' => 'smartcn',
                            'type' => 'text'
                        ]
                    ]
                ],
                'value' => function ($item) {
                    if (!isset($item->alt_titles)) {
                        return null;
                    }

                    // Remove [""] and other nonsense
                    $alt_titles = array_filter($item->alt_titles, 'strlen');

                    return count($alt_titles) > 0 ? $alt_titles : null;
                },
            ],
        ]);
    }

    protected function getFields()
    {
        return [
            'birth_date' => [
                'doc' => 'The year this agent was born',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'birth_place' => [
                'doc' => 'Name of the place this agent was born',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'death_date' => [
                'doc' => 'The year this agent died',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'death_place' => [
                'doc' => 'Name of the place this agent died',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'description' => [
                'doc' => 'A biographical description of the agent',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->webArtist->intro_copy ?? null;
                },
            ],
            'ulan_uri' => [
                'doc' => 'Unique identifier of this agent in Getty\'s ULAN',
                'type' => 'uri',
                'elasticsearch' => 'text',
                'is_restricted' => true,
            ],
            'is_licensing_restricted' => [
                'doc' => 'Whether the use of the images of works by this artist are restricted by licensing',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->licensing_restricted;
                },
            ],
            'is_artist' => [
                'doc' => 'Whether the agent is an artist. Solely based on whether the agent is listed as an artist for an artwork record.',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                'value' => function ($item) {
                    return $item->createdArtworks()->count() > 0;
                },
            ],

            // TODO: Refactor relationships:
            'agent_type_title' => [
                'doc' => 'Name of the type of agent, e.g. individual, fund, school, organization, etc.',
                'type' => 'string',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->agentType->title ?? null;
                },
            ],
            'agent_type_id' => [
                'doc' => 'Unique identifier of the type of agent, e.g. individual, fund, school, organization, etc.',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->agentType->citi_id ?? null;
                },
            ],
            'artwork_ids' => [
                'doc' => 'Unique identifiers of the works this artist created.',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->createdArtworkIds();
                },
            ],
            'site_ids' => [
                'doc' => 'Unique identifiers of the microsites this exhibition is a part of',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->sites->pluck('site_id');
                },
            ],
        ];
    }

    /**
     * Agents are a special case, wherein multiple names are common.
     *
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.3/search-suggesters.html
     * @link https://www.elastic.co/blog/you-complete-me (obsolete)
     * @link https://www.elastic.co/guide/en/elasticsearch/reference/5.0/breaking_50_suggester.html
     *
     * @return array
     */
    protected function getSuggestFields()
    {
        $suggestFields = $this->traitGetSuggestFields();

        $newFilter = function ($item) {
            return $item->createdArtworks()->count() > 0;
        };

        foreach (['suggest_autocomplete_all', 'suggest_autocomplete_boosted'] as $fieldName) {
            $oldFilter = $suggestFields[$fieldName]['filter'];
            $suggestFields[$fieldName]['filter'] = function ($item) use ($oldFilter, $newFilter) {
                return $oldFilter($item) && $newFilter($item);
            };
        }

        $suggestFields['suggest_autocomplete_boosted']['value'] = function ($item) {
            return [
                'input' => array_merge(
                    [
                        $item->title,
                        $item->sort_title,
                    ],
                    array_filter($item->alt_titles ?? [])
                ),
                'weight' => $item->isBoosted() ? 3 : 2,
            ];
        };

        $suggestFields['suggest_autocomplete_all']['value'] = function ($item) {
            return [
                'input' => array_merge(
                    [
                        $item->title,
                        $item->sort_title,
                    ],
                    array_filter($item->alt_titles ?? [])
                ),
                'weight' => $item->isBoosted() ? 3 : 2,
                'contexts' => [
                    'groupings' => [
                        'title',
                    ],
                ],
            ];
        };

        return $suggestFields;
    }
}
