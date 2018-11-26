<?php

namespace App\Console\Commands\Prototype;

use App\Models\Collections\Artwork;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class PrototypeMostSimilar extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proto:most-similar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output sharable file to demonstrate list of artworks "most similar" to another artwork';

    protected $fields = ['thumbnail','id','title','main_reference_number',
                         'artist_id','style_ids','classification_ids',
                         'date_start','date_end',
                         'color',
    ];

    protected $size = 12;

    protected $sizeRenderPerQuery = 4;

    protected $increments = [
        -8000,
        -7000,
        -6000,
        -5000,
        -4000,
        -3000,
        -2000,
        -1000,
        1,
        500,
        1000,
        1200,
        1400,
        1600,
        1700,
        1800,
        1900,
        1910,
        1920,
        1930,
        1940,
        1950,
        1960,
        1970,
        1980,
        1990,
        2000,
        2010];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $ret = $this->header("Prototype most similar");

        $ret .= $this->results([
            27992 => "La Grande Jatte",
            20684 => "Paris Street",
            64818 => "Stacks of Wheat",
            16568 => "Water Lillies",
            14655 => "Two Sisters",
            15468 => "Saint George and the Dragon",
            46327 => "Black Cross",
            86780 => "Mother and Child",
            52983 => "The Past and the Present",
        ]);

        $ret .= $this->footer();

        print $ret;
    }

    public function results($artworkIds = [], $limit = 5)
    {
        $ret = '';
        foreach ($artworkIds as $id => $name)
        {
            $ret .= "<h2><a href=\"" .env('WEBSITE_ROOT') ."/artworks/{$id}\">{$name}</a></h2>\n";

            $artw = Artwork::find($id);
            $responses = $this->query($artw);

            $ids = [$id];
            $ret .= "<table>\n";

            $count = 0;
            foreach ($responses as $response)
            {
                $countForCurrentQuery = 0;
                foreach ($response->data as $item)
                {
                    if (!in_array($item->id, $ids))
                    {
                        $ret .= "<tr class='clickable-row' data-href='http://www-2018.artic.edu/artworks/{$item->id}'>";
                        $ret .= "<td style=\"padding:0 8px\"><img src=\"" .($item->thumbnail->url ?? '') ."/full/75,/0/default.jpg\" /></td>";
                        $ret .= "<td style=\"padding:0 8px\">{$item->id}</td>";
                        $ret .= "<td style=\"padding:0 8px\">{$item->main_reference_number}</td>";
                        $ret .= "<td style=\"padding:0 8px\">{$item->title}</td>";
                        $ret .= "<td style=\"padding:0 8px\">{$this->type($item, $artw)}</td>";
                        $ret .= "</tr>\n";
                        $ids[] = $item->id;
                        $count++;
                        $countForCurrentQuery++;
                        if ($count == $this->size)
                        {
                            break 2;
                        }
                        if ($countForCurrentQuery == $this->sizeRenderPerQuery)
                        {
                            break;
                        }
                    }
                }
            }
            $ret .= "</table>\n";
            $ret .= "<br/><br/>\n";
        }

        return $ret;
    }

    public function type($item, $artw)
    {
        $ret = '';
        $date_start = $this->dateStart($artw->date_start);
        $date_end = $this->dateEnd($artw->date_start);
        if ($item->artist_id == $artw->artist->citi_id) {
            $ret ? $ret .= ', ' : '';
            $ret .= 'Same artist';
        }
        foreach ($item->style_ids as $style) {
            if (in_array($style, array_pluck($artw->styles, 'lake_uid'))) {
                $ret ? $ret .= ', ' : '';
                $ret .= 'Same style';
                break;
            }
        }
        foreach ($item->classification_ids as $classification) {
            if (in_array($classification, array_pluck($artw->classifications, 'lake_uid'))) {
                $ret ? $ret .= ', ' : '';
                $ret .= 'Same classification';
                break;
            }
        }
        if ($item->date_start >= $date_start && $item->date_end <= $date_end) {
            $ret ? $ret .= ', ' : '';
            $ret .= 'Similar point in time';
        }
        if ($artw->image && $artw->image->metadata && $artw->image->metadata->color && $item->color
            && in_array($item->color->h, range($artw->image->metadata->color->h - 5, $artw->image->metadata->color->h + 5))
            && in_array($item->color->s, range($artw->image->metadata->color->s - 5, $artw->image->metadata->color->s + 5))
            && in_array($item->color->l, range($artw->image->metadata->color->l - 5, $artw->image->metadata->color->l + 5))) {
            $ret ? $ret .= ', ' : '';
            $ret .= 'Similar color';
        }
        return $ret;
    }

    public function header($title = '')
    {
        $ret = "<html>\n";
        $ret .= "<head>\n";
        $ret .= "<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=\" crossorigin=\"anonymous\"></script>\n";
        $ret .= "<style>tr.clickable-row { cursor: pointer; }</style>\n";
        $ret .= "</head>\n";
        $ret .= "<body>\n";
        if ($title)
        {
            $ret .= "<h1>{$title}</h1>\n";
        }
        return $ret;
    }

    public function footer()
    {
        return "<script>\n"
            . "  jQuery(document).ready(function($) {\n"
            . "    $(\".clickable-row\").click(function() {\n"
            . "      window.location = $(this).data(\"href\");\n"
            . "    });\n"
            . "  });\n"
            . "</script>\n"
            . "</body>\n</html>\n";
    }

    public function dateStart($date)
    {
        foreach ($this->increments as $year)
        {
            if ($year > $date)
            {
                return $prev;
            }
            $prev = $year;
        }
    }

    public function dateEnd($date)
    {
        foreach ($this->increments as $year)
        {
            if ($year > $date)
            {
                return $year;
            }
        }
    }

    public function query($artw)
    {
        $date_start = $this->dateStart($artw->date_start);
        $date_end = $this->dateEnd($artw->date_start);

        $query = [
            $this->basicQuery('artist_id', $artw->artist->citi_id),
            $this->basicQuery('style_id', $artw->style->lake_uid),
            $this->basicQuery('classification_id', $artw->classification->citi_id),
            $this->dateQuery($date_start, $date_end),
        ];

        // Filter out empty array queries
        $query = array_filter($query);

        $ret = $this->curl($query);

        // Run the color query separately because it wasn't coming in the results when
        // mixed with the other queries
        if ($artw->image && $artw->image->metadata) {
            $query = [
                $this->colorQuery($artw->image->metadata->color),
            ];
            $ret = array_merge($ret, $this->curl($query));
        }
        return $ret;
    }

    protected function curl($query)
    {
        $queryString = json_encode($query);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('app.url') ."/api/v1/msearch");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($queryString)
        ]);

        $contents = curl_exec($ch);
        curl_close($ch);

        if (is_null($contents)) {
            throw new \Exception("Can't get artwork: " . $artw->citi_id);
        }
        return json_decode($contents);

    }

    protected function basicQuery($field, $value)
    {
        if (!$value)
        {
            return [];
        }
        return [
            "resources" => "artworks",
            "query" => [
                "term" => [
                    $field => $value,
                ],
            ],
            "fields" => $this->fields,
            "size" => $this->size,
        ];
    }

    protected function dateQuery($date_start, $date_end)
    {
        return [
            "resources" => "artworks",
            "query" => [
                "bool" => [
                    "must" => [
                        [
                            "range" => [
                                "date_start" => [
                                    "gte" => $date_start
                                ]
                            ]
                        ],
                        [
                            "range" => [
                                "date_end" => [
                                    "lte" => $date_end
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            "fields" => $this->fields,
            "size" => $this->size,
        ];
    }

    protected function colorQuery($color)
    {
        if (!$color) {
            return [];
        }
        return [
            "resources" => "artworks",
            "query" => [
                "bool" => [
                    "must" => [
                        [
                            "range" => [
                                "color.h" => [
                                    "gte" => ($color->h - 5),
                                    "lte" => ($color->h + 5),
                                ]
                            ]
                        ],
                        [
                            "range" => [
                                "color.s" => [
                                    "gte" => ($color->s - 5),
                                    "lte" => ($color->s + 5),
                                ]
                            ]
                        ],
                        [
                            "range" => [
                                "color.l" => [
                                    "gte" => ($color->l - 5),
                                    "lte" => ($color->l + 5),
                                ]
                            ]
                        ]
                    ],
                ],
            ],
            "fields" => $this->fields,
            "size" => $this->size,
        ];
    }
}
