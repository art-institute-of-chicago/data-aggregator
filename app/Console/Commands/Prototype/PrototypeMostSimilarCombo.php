<?php

namespace App\Console\Commands\Prototype;

use App\Models\Collections\Artwork;

use Illuminate\Support\Arr;

class PrototypeMostSimilarCombo extends PrototypeMostSimilar
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proto:most-similar-combo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uses logic from most-similar, but runs all clauses in one query';

    protected $sizeRenderPerQuery = 12;

    public function query($artw)
    {
        $date_start = $this->dateStart($artw->date_start);
        $date_end = $this->dateEnd($artw->date_start);

        $query = [
            $this->basicQueryBoosted('artist_ids', Arr::pluck($artw->artists, 'citi_id'), 5),
            $this->basicQueryBoosted('style_ids', Arr::pluck($artw->styles, 'lake_uid'), 1),
            // $this->basicQueryBoosted('subject_ids', Arr::pluck($artw->subjects, 'lake_uid'), 5),
            $this->basicQueryBoosted('classification_ids', Arr::pluck($artw->classifications, 'lake_uid'), 1),
        ];

        $dateQuery = $this->dateQuery($date_start, $date_end);
        $dateQuery['query']['bool']['boost'] = 1;

        array_push($query, $dateQuery);

        if ($artw->image->metadata->color ?? false) {
            $colorQuery = $this->colorQuery($artw->image->metadata->color);
            $colorQuery['query']['bool']['boost'] = 1;
            array_push($query, $colorQuery);
        }

        // Filter out empty array queries
        $query = array_filter($query);

        // Combine the queries into one (for msearch)
        $query = [
            [
                "resources" => "artworks",
                "query" => [
                    "bool" => [
                        "should" => collect($query)->pluck('query')->all(),
                    ]
                ],
                "q" => null,
                "fields" => $this->fields,
                "size" => $this->size,
            ]
        ];

        return $this->curl($query);

    }

    protected function basicQueryBoosted($field, $value, $boost)
    {
        if (!$value)
        {
            return [];
        }
        return [
            "resources" => "artworks",
            "query" => [
                "terms" => [
                    $field => $value,
                    "boost" => $boost,
                ],
            ],
            "fields" => $this->fields,
            "size" => $this->size,
        ];
    }

}
