<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Collections\Artwork;
use App\Models\Collections\Asset;
use Aic\Hub\Foundation\Exceptions\InvalidSyntaxException;
use Aic\Hub\Foundation\Exceptions\TooManyIdsException;
use App\Http\Controllers\Controller as BaseController;

class LinkedArtController extends BaseController
{
    public const LIMIT_MAX = 100;

    public function showObject(Request $request, $id)
    {
        $artwork = Artwork::find($id);

        return $this->itemResponse($artwork);
    }

    /**
     * Display multiple resources.
     *
     * @param string $ids
     * @return \Illuminate\Http\Response
     */
    protected function showMultiple(Request $request)
    {
        // Process ?ids= query param
        $ids = $request->input('ids');

        if (is_string($ids)) {
            $ids = explode(',', $ids);
        }

        if (Gate::denies('restricted-access') && count($ids) > static::LIMIT_MAX) {
            throw new TooManyIdsException();
        }

        // Validate the syntax for each $id
        foreach ($ids as $id) {
            if (!$this->validateId($id)) {
                throw new InvalidSyntaxException();
            }
        }

        // Illuminate\Database\Eloquent\Collection
        $all = Artwork::find($ids);

        return $this->getCollectionResponse($all, $request);
    }

    protected function itemResponse(Artwork $artwork)
    {
        $item = [
            '@context' => 'https://linked.art/ns/v1/linked-art.json',
            'id' => route('ld.object', ['id' => $artwork]),
            'type' => 'HumanMadeObject',
        ];

        $item = array_merge_recursive(
            $item,
            $this->getArtworkType($artwork),
            $this->getIdentifiers($artwork),
            $this->getTitles($artwork),
            $this->getCurrentOwner($artwork),
            $this->getProduction($artwork),
            $this->getDimensions($artwork),
            $this->getMaterial($artwork),
            $this->getMaterialStatement($artwork),
            $this->getDimensionStatement($artwork),
            $this->getSubject($artwork),
            $this->getRepresentation($artwork),
            $this->getCreditStatement($artwork),
            $this->getProvenanceStatement($artwork),
            $this->getBibliographyStatement($artwork),
            $this->getExhibitionStatement($artwork),
            $this->getExtraLinkedArtJson($artwork),
        );

        return $item;
    }

    /**
     * Return a response with multiple resources, given an arrayable object.
     * For multiple ids, this is a an Eloquent Collection.
     * For pagination, this is LengthAwarePaginator.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getCollectionResponse(Arrayable $collection, Request $request)
    {
        $response = ['objects' => []];

        foreach ($collection as $artwork) {
            $response['objects'][] = [
                $artwork->id => $this->itemResponse($artwork)
            ];
        }

        return response()->json($response);
    }

    private function getArtworkType($artwork): array
    {
        $artworkType = $artwork->artworkType;

        return [
            'classified_as' => array_values(array_filter(array_merge([
                $artworkType && $artworkType->aat_id ? [
                    'id' => 'http://vocab.getty.edu/aat/' . $artworkType->aat_id,
                    'type' => 'Type',
                    '_label' => $artworkType->title,
                ] : [],
                $artwork->nomisma_id ? [
                    'id' => $artwork->nomisma_id,
                    'type' => 'Type',
                    '_label' => null,
                    'classified_as' => [
                        [
                            'id' => 'aat:300067209',
                            'type' => 'Type',
                            '_label' => 'typology'
                        ]
                    ]
                  ] : [],
            ]))),
        ];
    }

    private function getIdentifiers($artwork): array
    {
        $identifiers = [];

        if ($artwork->main_id) {
            $identifiers[] = [
                'type' => 'Identifier',
                'content' => $artwork->main_id,
                'classified_as' => [
                    [
                        'id' => 'http://vocab.getty.edu/aat/300312355',
                        'type' => 'Type',
                        '_label' => 'accession number',
                    ],
                ],
            ];
        }

        if (empty($identifiers)) {
            return [];
        }

        return [
            'identified_by' => $identifiers,
        ];
    }

    private function getTitles($artwork): array
    {
        if (empty($artwork->title)) {
            return [];
        }

        return [
            'identified_by' => [
                [
                    'type' => 'Name',
                    'content' => $artwork->title,
                    'language' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300388277',
                            'type' => 'Language',
                            '_label' => 'English',
                        ],
                    ],
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300404670',
                            'type' => 'Type',
                            '_label' => 'Preferred terms',
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * TODO: Do we need to handle loans?
     */
    private function getCurrentOwner($artwork): array
    {
        return [
            'current_owner' => [
                [
                    'id' => 'http://vocab.getty.edu/ulan/500304669',
                    'type' => 'Group',
                    '_label' => 'Art Institute of Chicago',
                ],
            ],
        ];
    }

    private function getProduction($artwork): array
    {
        $production = [
            'type' => 'Production',
        ];

        $artists = $artwork
            ->artists
            ->filter(fn ($artist) => !empty($artist->ulan_id))
            ->unique('ulan_id')
            ->map(fn ($artist) => [
                'id' => 'http://vocab.getty.edu/ulan/' . $artist->ulan_id,
                'type' => 'Actor',
            ])
            ->values()
            ->all();

        if (count($artists) > 0) {
            $production['carried_out_by'] = $artists;
        }

        $techniques = collect($artwork
            ->techniques)
            ->filter(fn ($technique) => !empty($technique->aat_id))
            ->unique('aat_id')
            ->map(fn ($technique) => [
                'id' => 'http://vocab.getty.edu/aat/' . $technique->aat_id,
                // ...do we need to capture type during reconciliation?
                'type' => 'Type',
                '_label' => $technique->title,
            ])
            ->values()
            ->all();

        if (count($techniques) > 0) {
            $production['technique'] = $techniques;
        }

        // TODO: Provide `took_place_at` [API-12]
        $timespan = [
            'type' => 'TimeSpan',
            'begin_of_the_begin' => !empty($artwork->date_start)
                ? (new Carbon($this->year($artwork->date_start) . '-01-01T00:00:00'))->toIso8601ZuluString()
                : null,
            'end_of_the_end' => !empty($artwork->date_end)
                ? (new Carbon($this->year($artwork->date_end) . '-12-31T23:59:59'))->toIso8601ZuluString()
                : null,
        ];

        if (!empty($artwork->date_display)) {
            $timespan['identified_by'] = [
                [
                    'type' => 'Name',
                    'content' => $artwork->date_display,
                    'language' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300388277',
                            'type' => 'Language',
                            '_label' => 'English',
                        ]
                    ]
                ]
            ];
        }

        $production['timespan'] = $timespan;

        return [
            'produced_by' => $production,
        ];
    }

    private function getDimensions($artwork): array
    {
        $dimensions = [];

        $unit = [
            'id' => 'http://vocab.getty.edu/aat/300379097',
            'type' => 'MeasurementUnit',
            '_label' => 'millimeters',
        ];

        if ($diameterValue = $artwork->dimensions_detail[0]['diameter_cm'] ?? 0) {
            $dimensions[] = [
                'type' => 'Dimension',
                'value' => $diameterValue * 10,
                'classified_as' => [
                    [
                        'id' => 'http://vocab.getty.edu/aat/300055624',
                        'type' => 'Type',
                        '_label' => 'diameter',
                    ],
                ],
                'unit' => $unit,
            ];
        }

        if ($widthValue = $artwork->dimensions_detail[0]['width_cm'] ?? 0) {
            $dimensions[] = [
                'type' => 'Dimension',
                'value' => $widthValue * 10,
                'classified_as' => [
                    [
                        'id' => 'http://vocab.getty.edu/aat/300055647',
                        'type' => 'Type',
                        '_label' => 'width',
                    ],
                ],
                'unit' => $unit,
            ];
        }

        if ($heightValue = $artwork->dimensions_detail[0]['height_cm'] ?? 0) {
            $dimensions[] = [
                'type' => 'Dimension',
                'value' => $heightValue * 10,
                'classified_as' => [
                    [
                        'id' => 'http://vocab.getty.edu/aat/300055644',
                        'type' => 'Type',
                        '_label' => 'height',
                    ],
                ],
                'unit' => $unit,
            ];
        }

        return [
            'dimension' => $dimensions,
        ];
    }

    private function getMaterial($artwork): array
    {
        $materials = collect($artwork
            ->materials)
            ->filter(fn ($material) => !empty($material->aat_id))
            ->unique('aat_id')
            ->map(fn ($material) => [
                'id' => 'http://vocab.getty.edu/aat/' . $material->aat_id,
                'type' => 'Material',
                '_label' => $material->title,
            ])
            ->values()
            ->all();

        if (count($materials) < 1) {
            return [];
        }

        return [
            'made_of' => $materials,
        ];
    }

    private function getMaterialStatement($artwork): array
    {
        if (empty($artwork->medium_display)) {
            return [];
        }

        return [
            'referred_to_by' => [
                [
                    'type' => 'LinguisticObject',
                    'content' => $artwork->medium_display,
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300435429',
                            'type' => 'Type',
                            '_label' => 'Material Statement',
                            'classified_as' => [
                                [
                                    'id' => 'http://vocab.getty.edu/aat/300418049',
                                    'type' => 'Type',
                                    '_label' => 'Brief Text',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    private function getDimensionStatement($artwork): array
    {
        if (empty($artwork->dimensions)) {
            return [];
        }

        return [
            'referred_to_by' => [
                [
                    'type' => 'LinguisticObject',
                    'content' => $artwork->dimensions,
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300435430',
                            'type' => 'Type',
                            '_label' => 'Dimension Statement',
                            'classified_as' => [
                                [
                                    'id' => 'http://vocab.getty.edu/aat/300418049',
                                    'type' => 'Type',
                                    '_label' => 'Brief Text',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    private function getSubject($artwork): array
    {
        $subjects = collect($artwork
            ->subjects)
            ->filter(fn ($subject) => !empty($subject->aat_id))
            ->unique('aat_id')
            ->map(fn ($subject) => [
                'type' => 'VisualItem',
                'classified_as' => [
                    [
                        'id' => 'http://vocab.getty.edu/aat/' . $subject->aat_id,
                        'type' => 'Type',
                        '_label' => $subject->title,
                    ],
                ],
            ])
            ->values()
            ->all();

        if (count($subjects) < 1) {
            return [];
        }

        return [
            'shows' => $subjects,
        ];
    }

    /**
     * TODO: Provide non-preferred images
     */
    private function getRepresentation($artwork): array
    {
        if (empty($artwork->image)) {
            return [];
        }

        return [
            'representation' => [
                [
                    'id' => config('aic.config_documentation.iiif_url') . '/' . Asset::getHashedId($artwork->image->getKey()),
                    'type' => 'VisualItem',
                    'conforms_to' => [
                        [
                            'id' => 'http://iiif.io/api/image'
                        ],
                    ],
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300215302',
                            'type' => 'Type',
                            '_label' => 'digital images',
                        ],
                    ],
                ],
            ],
        ];
    }

    private function getCreditStatement($artwork): array
    {
        if (empty($artwork->credit_line)) {
            return [];
        }

        return [
            'referred_to_by' => [
                [
                    'type' => 'LinguisticObject',
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300026687',
                            'type' => 'Type',
                            '_label' => 'Credit Statement',
                            'classified_as' => [
                                [
                                    'id' => 'http://vocab.getty.edu/aat/300418049',
                                    'type' => 'Type',
                                    '_label' => 'Brief Text',
                                ],
                            ],
                        ],
                    ],
                    'content' => $artwork->credit_line
                ],
            ],
        ];
    }

    private function getProvenanceStatement($artwork): array
    {
        if (empty($artwork->provenance)) {
            return [];
        }

        return [
            'referred_to_by' => [
                [
                    'type' => 'LinguisticObject',
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300435438',
                            'type' => 'Type',
                            '_label' => 'Provenance Statement',
                            'classified_as' => [
                                [
                                    'id' => 'http://vocab.getty.edu/aat/300418049',
                                    'type' => 'Type',
                                    '_label' => 'Brief Text',
                                ],
                            ],
                        ],
                    ],
                    'content' => $artwork->provenance
                ],
            ],
        ];
    }

    private function getBibliographyStatement($artwork): array
    {
        if (empty($artwork->publication_history)) {
            return [];
        }

        return [
            'referred_to_by' => [
                [
                    'type' => 'LinguisticObject',
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300026497',
                            'type' => 'Type',
                            '_label' => 'Bibliography Statement',
                            'classified_as' => [
                                [
                                    'id' => 'http://vocab.getty.edu/aat/300418049',
                                    'type' => 'Type',
                                    '_label' => 'Brief Text',
                                ],
                            ],
                        ],
                    ],
                    'content' => $artwork->publication_history
                ],
            ],
        ];
    }

    private function getExhibitionStatement($artwork): array
    {
        if (empty($artwork->exhibition_history)) {
            return [];
        }

        return [
            'referred_to_by' => [
                [
                    'type' => 'LinguisticObject',
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300435424',
                            'type' => 'Type',
                            '_label' => 'Exhibition Statement',
                            'classified_as' => [
                                [
                                    'id' => 'http://vocab.getty.edu/aat/300418049',
                                    'type' => 'Type',
                                    '_label' => 'Brief Text',
                                ],
                            ],
                        ],
                    ],
                    'content' => $artwork->exhibition_history
                ],
            ],
        ];
    }

    private function getExtraLinkedArtJson($artwork): array
    {
        if (empty($artwork->linked_art_json)) {
            return [];
        }

        // convert object to array recursively
        return json_decode(json_encode($artwork->linked_art_json), true);
    }

    /**
     * Validate `id` route or query string param format.
     *
     * @param mixed $id
     * @return boolean
     */
    protected function validateId($id)
    {
        // Only execute this validation if the model has defined a `validateId` method
        if (method_exists(Artwork::class, 'validateId')) {
            return Artwork::validateId($id);
        }

        return true;
    }

    private function year($year)
    {
        if ($year < 0) {
            return '-' . Str::padLeft(($year * -1), 4, '0');
        } else {
            return Str::padLeft($year, 4, '0');
        }
    }
}
