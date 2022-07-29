<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\StaticArchive\Site as SiteTransformer;

use App\Transformers\Outbound\HasSuggestFields;
use App\Transformers\Outbound\Collections\Traits\IsCC0;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class Agent extends BaseTransformer
{

    use IsCC0;
    use HasSuggestFields {
        getSuggestFields as traitGetSuggestFields;
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
            ],
            'alt_titles' => [
                'doc' => 'Alternate names for this agent',
                'type' => 'array',
                'elasticsearch' => [
                    'default' => true,

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
            'is_artist' => [
                'doc' => 'Whether the agent is an artist. Solely based on whether the agent is related to an artwork record.',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
                // API-94: Allow dev to specify what `withCount` is needed for each field!
                'value' => function ($item) {
                    return $item->created_artworks_count > 0;
                },
            ],
            'birth_date' => [
                'doc' => 'The year this agent was born',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'death_date' => [
                'doc' => 'The year this agent died',
                'type' => 'number',
                'elasticsearch' => 'integer',
            ],
            'description' => [
                'doc' => 'A biographical description of the agent',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                    'mapping' => [
                        'type' => 'text',
                    ],
                ],
                'value' => function ($item) {
                    return $item->webArtist->intro_copy ?? null;
                },
            ],
            'ulan_id' => [
                'doc' => 'Unique identifier of this agent in Getty\'s ULAN',
                'type' => 'number',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->ulan_certainty > 3 ? $item->ulan_id : null;
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
                    return $item->agentType->id ?? null;
                },
            ],
        ];
    }

    /**
     * Agents are a special case, wherein multiple names are common.
     *
     * @todo API-94: Add `withCount` for `createdArtworks` here
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
            return $item->created_artworks_count > 0;
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
