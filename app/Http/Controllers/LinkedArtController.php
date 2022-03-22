<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Collections\Artwork;
use App\Models\Collections\Asset;

use App\Http\Controllers\Controller as BaseController;

class LinkedArtController extends BaseController
{
    private $fnumbers = [
        28560 => 'F484',
        80607 => 'F345',
        14586 => 'F470',
        28862 => 'F139',
        79349 => 'F667',
        109314 => 'F354',
        27949 => 'F506',
        27954 => 'F272',
        64957 => 'F382',
        52733 => 'F1468',
        59774 => 'F1069',
        31640 => 'F1240a',
        65479 => 'F1642',
        87327 => 'F1524',
        150802 => 'F1690',
        133605 => 'F1518',
        88393 => null,
        202382 => 'F1241',
    ];

    public function artwork(Request $request, $id)
    {
        $artwork = Artwork::find($id);

        $item = [
            '@context' => 'https://linked.art/ns/v1/linked-art.json',
            'id' => route('ld.artwork', ['id' => $artwork]),
            'type' => 'HumanMadeObject',
        ];

        $item = array_merge_recursive(
            $item,
            $this->getArtworkType($artwork),
            $this->getLinkToVgwUri($artwork),
            $this->getIdentifiers($artwork),
            $this->getTitles($artwork),
            $this->getCurrentOwner($artwork),
            $this->getProduction($artwork),
            $this->getDimensions($artwork),
            $this->getMaterial($artwork),
            $this->getSupportMaterial($artwork),
            $this->getMaterialStatement($artwork),
            $this->getSubject($artwork),
            $this->getRepresentation($artwork),
        );

        return $item;
    }

    private function getArtworkType($artwork): array
    {
        if (!$artworkType = $artwork->artworkType) {
            return [];
        }

        if (!$artworkType->aat_id) {
            return [];
        }

        return [
            'classified_as' => [
                [
                    'id' => 'http://vocab.getty.edu/aat/' . $artworkType->aat_id,
                    'type' => 'Type',
                    '_label' => $artworkType->title,
                ],
            ],
        ];
    }

    private function getLinkToVgwUri($artwork): array
    {
        $fnumber = $this->fnumbers[$artwork->getKey()] ?? null;

        if (!$fnumber) {
            return [];
        }

        return [
            'see_also' => [
                [
                    'id' => 'https://vangoghworldwide.org/data/artwork/' . $fnumber,
                ],
            ],
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

        if ($fnumber = $this->fnumbers[$artwork->getKey()] ?? null) {
            $identifiers[] = [
                'type' => 'Identifier',
                'content' => $fnumber,
                'classified_as' => [
                    [
                        'id' => 'https://vangoghworldwide.org/data/concept/f_number',
                        'type' => 'Type',
                        '_label' => 'De La Faille number',
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
                ? (new Carbon($artwork->date_start . '-01-01T00:00:00Z'))->toIso8601ZuluString()
                : null,
            'end_of_the_end' => !empty($artwork->date_end)
                ? (new Carbon($artwork->date_end . '-12-31T23:59:59Z'))->toIso8601ZuluString()
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

        if (!empty($artwork->dimension_width)) {
            $dimensions[] = [
                'type' => 'Dimension',
                'value' => $artwork->dimension_width,
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

        if (!empty($artwork->dimension_height)) {
            $dimensions[] = [
                'type' => 'Dimension',
                'value' => $artwork->dimension_height,
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

    private function getSupportMaterial($artwork): array
    {
        if (empty($artwork->support_aat_id)) {
            return [];
        }

        return [
            'part' => [
                [
                    'type' => 'HumanMadeObject',
                    'classified_as' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/300014844',
                            'type' => 'Type',
                            '_label' => 'Support',
                        ],
                    ],
                    'made_of' => [
                        [
                            'id' => 'http://vocab.getty.edu/aat/' . $artwork->support_aat_id,
                            'type' => 'Material',
                        ],
                    ],
                ],
            ],
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
}
