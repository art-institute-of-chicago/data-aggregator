<?php

namespace App\Console\Commands\Dump;

use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Uri;

#[Signature('dump:artwork-to-exhibition')]
#[Description('Create a CSV of artwork ids to exhibition ids based on exhibition history.')]
class DumpArtworkExhibitionHistory extends AbstractDumpCommand
{
    public const ALLOWED_HOSTS = ['archive.artic.edu', 'www.artic.edu'];

    public const INSTITUTE_TITLES = [
        // Contain at least 20 of the same characters with at least an 80%
        // match; finds names such as:
        // - Art Institute Of Chicago
        // - The Art Institute of Chicago
        // - Probably Art Institute of Chicago
        // ... as well as some misspellings.
        [
            'text' => 'Art Institute of Chicago',
            'similarity' => 20,
            'percent' => 80,
        ],
        // Contain at least 3 of the same characters with at least a 33% match;
        // finds names such as:
        // - AIC exhibition
        // - A.I.C."
        [
            'text' => 'AIC',
            'similarity' => 3,
            'percent' => 33,
        ],
    ];

    public const TITLE_SEPARATORS = [',', ';', ':', '-', '. '];

    public const TITLE_ANOMALIES = [
        ' 05/24/2023',
        ' Chinese',
        '2009. ',
        '2011. ',
        'On loan to ',
        'Recto: ',
    ];

    public const EXHIBITION_SIMILARITY = .90; // 90%

    public Collection $artworksWithExhibitionHistory;

    public Collection $exhibitionTitlesById;

    public array $aicMatches = [];

    public array $exhibitionMatches = [];

    public function handle()
    {
        $this->info('Loading artworks with exhibition history');
        $this->artworksWithExhibitionHistory = Artwork::whereNotNull('exhibition_history')->get();
        $artworkCount = $this->artworksWithExhibitionHistory->count();
        Log::info("Artwork Exhibition History: {$artworkCount} artworks with exhibition history");

        $titles = collect(self::INSTITUTE_TITLES)->pluck('text')->map(fn($title) => "\"$title\"")->join(', ');
        $this->info("Matching entries with similar institute titles: {$titles}");
        $this->setAicMatches();
        $aicMatchCount = collect($this->aicMatches)->flatten(1)->count();
        Log::info("Artwork Exhibition History: {$aicMatchCount} {$titles} exhibition history entries");

        $this->info('Loading exhibition titles');
        $this->exhibitionTitlesById = Exhibition::all()->pluck('title', 'id');
        $exhibitionCount = $this->exhibitionTitlesById->count();
        Log::info("Artwork Exhibition History: {$exhibitionCount} exhibitions");

        $this->info('Matching exhibitions by title');
        $this->setExhibitionMatches();
        $exhibitionMatchCount = collect($this->exhibitionMatches)->count();
        Log::info("Artwork Exhibition History: {$exhibitionMatchCount} matching exhibitions");

        $this->info('Saving matches to file');
        $path = $this->saveToCsv();
        Log::info("Artwork Exhibition History: {$exhibitionMatchCount} entries saved to $path");

        $this->info('Done!');
    }

    protected function setAicMatches(): void
    {
        foreach ($this->artworksWithExhibitionHistory as $artwork) {
            foreach (preg_split("/\n/", $artwork->exhibition_history) as $exhibitionHistory) {
                $exhibitionParts = [];
                foreach (self::TITLE_SEPARATORS as $seperator) {
                    $exhibitionParts = array_map(trim(...), explode($seperator, $exhibitionHistory, 2));
                    if (count($exhibitionParts) == 2) {
                        foreach ($this->findAicReferences($exhibitionParts) as $institute => $description) {
                            $this->aicMatches[$artwork->id][] = [
                                'exhibition_history' => $exhibitionHistory,
                                'institute' => $institute,
                                'description' => $description,
                            ];
                        }
                    }
                }
            }
        }
    }

    protected function setExhibitionMatches()
    {
        foreach ($this->aicMatches as $artworkId => $matches) {
            foreach ($matches as $match) {
                $metadata = [
                    'artwork_id' => $artworkId,
                    'exhibition_history' => $match['exhibition_history']
                ];
                foreach ([
                    'findByUrl',
                    'findByTitle',
                    'findBySimilarTitle'
                ] as $method) {
                    $exhibitions = $this->$method($metadata, $match);
                    if (!empty($exhibitions)) {
                        $this->exhibitionMatches = array_merge($this->exhibitionMatches, $exhibitions);
                    }
                }
            }
        }
    }

    protected function saveToCsv()
    {
        $matches = collect($this->exhibitionMatches)->sortBy([['artwork_id', 'asc'], ['exhibition_id', 'asc']]);
        $path = storage_path('app/exhibition_history-' . now()->format('Y-m-d-His') . '.csv');
        $csv = fopen($path, 'w');
        fwrite($csv, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM
        fputcsv($csv,
            [
                'artwork_id',
                'exhibition_id',
                'exhibition_title',
                'match_type',
                'exhibition_history',
            ],
            separator: "\t",
        );
        foreach ($matches as $match) {
            fputcsv($csv,
                [
                    (int) $match['artwork_id'],
                    (int) $match['exhibition_id'],
                    $match['exhibition_title'],
                    $match['match_type'],
                    addslashes($match['exhibition_history']),
                ],
                separator: "\t",
            );
        }

        return $path;
    }

    private function findAicReferences(array $exhibitionParts): array
    {
        [$institute, $description] = $exhibitionParts;
        foreach (self::TITLE_ANOMALIES as $anomaly) {
            if (str($institute)->contains($anomaly)) {
                $institute = str_replace($anomaly, '', $institute);
            }
        }
        $aicReferences = [];
        if (! str($institute)->contains(self::TITLE_SEPARATORS)) {
            foreach (self::INSTITUTE_TITLES as $title) {
                $percent = 0.0;
                $similarity = similar_text($institute, $title['text'], $percent);
                if ($similarity >= $title['similarity'] && $percent >= $title['percent']) {
                    $aicReferences[$institute] = $description;
                }
            }
        }

        return $aicReferences;
    }

    private function findByUrl(array $metadata, array $match): array
    {
        $matches = [];
        $uriMatches = [];
        preg_match('/a href="([^"]*)"/', $match['description'], $uriMatches);
        if (isset($uriMatches[1]) && str($uriMatches[1])->isUrl()) {
            $uri = Uri::of($uriMatches[1]);
            $host = $uri->host();
            $segments = $uri->pathSegments();
            if (in_array($host, self::ALLOWED_HOSTS) && $segments[0] == 'exhibitions') {
                $exhibition = Exhibition::find($segments[1]);
                $matches[] = $metadata + [
                    'match_type' => 'url',
                    'exhibition_id' => $exhibition->id,
                    'exhibition_title' => $exhibition->title,
                ];
            }
        }
        return $matches;
    }

    private function findByTitle(array $metadata, array $match): array
    {
        $matches = [];
        $titleMatches = [];
        preg_match('/(?<!a href=)"([^"]*)"/', $match['description'], $titleMatches);
        if (isset($titleMatches[1])) {
            $normalizedTitle = trim($titleMatches[1], ',.');
            foreach (Exhibition::whereLike('title', "%$normalizedTitle%")->get() as $exhibition) {
                $matches[] = $metadata + [
                    'match_type' => 'title',
                    'exhibition_id' => $exhibition->id,
                    'exhibition_title' => $exhibition->title,
                ];
            }
        }
        return $matches;
    }

    private function findBySimilarTitle(array $metadata, array $match): array
    {
        $matches = [];
        $titleMatches = [];
        preg_match('/(?<!a href=)"([^"]*)"/', $match['description'], $titleMatches);
        if (isset($titleMatches[1])) {
            foreach ($this->exhibitionTitlesById as $id => $title) {
                $percent = 0.0;
                $similarity = similar_text($title, $titleMatches[1], $percent);
                if ($percent >= (self::EXHIBITION_SIMILARITY * 100) &&
                    $similarity >= (self::EXHIBITION_SIMILARITY * strlen($title))
                ) {
                    $matches[] = $metadata + [
                        'match_type' => 'similarity',
                        'exhibition_id' => $id,
                        'exhibition_title' => $title,
                    ];
                }
            }
        }
        return $matches;
    }
}
