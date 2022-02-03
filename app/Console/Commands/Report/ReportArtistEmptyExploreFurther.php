<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Agent;
use App\Http\Search\Request;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

use Elasticsearch;

class ReportArtistEmptyExploreFurther extends BaseCommand
{

    public static $filename = 'artist-empty-explore-further.csv';

    protected $signature = 'report:artist-empty-explore-further';

    protected $description = 'Report all artists whose Explore Further tabs are emnpty';

    protected $csv;

    public function handle()
    {
        // Not an ideal solution, but some models are really heavy
        ini_set('memory_limit', '-1');
        \DB::connection()->getPdo()->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

        $this->csv = Writer::createFromPath($this->getCsvPath(), 'w');

        $this->csv->insertOne([
            'artist_id',
            'title',
            'web_url',
            'notes'
        ]);

        $artists = Agent::artists();
        $total = $artists->count();
        $count = 0;

        foreach ($artists->cursor() as $artist) {
            $params = ( new Request() )->getSearchParams([
                'resources' => 'artworks',
                'limit' => 1,
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'term' => [
                                    'artist_ids' => $artist->citi_id
                                ]
                            ]
                        ]
                    ],
                ],
                'aggregations' => [
                    'place_of_origin' => [
                        'terms' => [
                            'field' => 'place_of_origin.keyword',
                            'size' => 1,
                        ]
                    ],
                    'styles' => [
                        'terms' => [
                            'field' => 'style_titles.keyword',
                            'size' => 1,
                        ]
                    ]
                ]
            ], true);

            $results = Elasticsearch::search($params);

            $place_of_origin = $results['aggregations']['place_of_origin']['buckets'][0]['key'] ?? null;
            $style = $results['aggregations']['styles']['buckets'][0]['key'] ?? null;

            if (!$place_of_origin && !$style) {
                $this->info($artist->citi_id . '	' . $artist->title . '	' . 'https://www.artic.edu/artists/' . $artist->citi_id . '	No place_of_origin or style on any artwork records related to this artist');
                $this->csv->insertOne([$artist->citi_id, $artist->title, 'http://www.artic.edu/artists/' . $artist->citi_id, 'No place_of_origin or style on any artwork records related to this artist']);
            } else {
                $shoulds = [];

                if ($place_of_origin) {
                    $shoulds[] = [
                        'match' => [
                            'place_of_origin' => $place_of_origin
                        ]
                    ];
                }

                if ($style) {
                    $shoulds[] = [
                        'match' => [
                            'style_titles' => $style
                        ]
                    ];
                }

                $shoulds[] = [
                    'bool' => [
                        'must' => [
                            [
                                'range' => [
                                    'date_start' => [
                                        'gte' => $artist->birth_date
                                    ]
                                ]
                            ],
                            [
                                'range' => [
                                    'date_end' => [
                                        'lte' => $artist->death_date ?? date('Y')
                                    ]
                                ]
                            ]
                        ]
                    ]
                ];

                $params = ( new Request() )->getSearchParams([
                    'resources' => 'artworks',
                    'limit' => 13,
                    'size' => 13,
                    'offset' => 0,
                    'from' => 0,
                    'boost' => false,
                    'page' => 1,
                    'fields' => ['id', 'title'],
                    'query' => [
                        'bool' => [
                            'should' => $shoulds,
                            'minimum_should_match' => 2,
                            'filter' => [
                                'exists' => [
                                    'field' => 'image_id'
                                ]
                            ],
                            'must_not' => [
                                'term' => [
                                    'artist_id' => 37259
                                ]
                            ]
                        ]
                    ]
                ]);
                $results = Elasticsearch::search($params);

                if ($results['hits']['total'] == 0) {
                    $this->info($artist->citi_id . '	' . $artist->title . '	' . 'https://www.artic.edu/artists/' . $artist->citi_id . '	No results in Most Similar search');
                    $this->csv->insertOne([$artist->citi_id, $artist->title, 'http://www.artic.edu/artists/' . $artist->citi_id, 'No results in Most Similar']);
                }
            }
        }
        Storage::put(self::$filename, $this->csv->getContent());
    }

    private function getCsvPath()
    {
        return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . self::$filename;
    }
}
