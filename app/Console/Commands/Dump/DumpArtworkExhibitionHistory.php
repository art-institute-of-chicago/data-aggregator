<?php

namespace App\Console\Commands\Dump;

use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Support\Collection;
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

    public Collection $artworksWithExhibitionHistory;

    public array $aicMatches = [];

    public array $exhibitions = [];

    public function handle()
    {
        $this->info('Loading artworks with exhibition history');
        $this->artworksWithExhibitionHistory = Artwork::whereNotNull('exhibition_history')->get();
        $matchCount = $this->artworksWithExhibitionHistory->count();
        $this->info("Found: {$matchCount} artworks");

        $titles = collect(self::INSTITUTE_TITLES)->pluck('text')->join(', ');
        $this->info("Matching: {$titles}");
        $this->setAicMatches();
        $matchCount = collect($this->aicMatches)->flatten(1)->count();
        $this->info("Found: {$matchCount} exhibition history matches");

        $this->info('Matching: exhibitions');
        $this->setExhibitions();
        $matchCount = collect($this->exhibitions)->count();
        $this->info("Found: {$matchCount} exhibitions");

        $path = $this->saveToCsv();
        $this->info("Saved to $path");
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

    protected function setExhibitions()
    {
        $this->info('- Matching on `a href=`');
        $matchCount = 0;
        foreach ($this->aicMatches as $artworkId => $exhibitions) {
            foreach ($exhibitions as $exhibition) {
                $uriMatches = [];
                preg_match('/a href="([^"]*)"/', $exhibition['description'], $uriMatches);
                if (isset($uriMatches[1]) && str($uriMatches[1])->isUrl()) {
                    $uri = Uri::of($uriMatches[1]);
                    $host = $uri->host();
                    $segments = $uri->pathSegments();
                    if (in_array($host, self::ALLOWED_HOSTS) && $segments[0] == 'exhibitions') {
                        $matchCount++;
                        $this->exhibitions[] = [
                            'artwork_id' => $artworkId,
                            'exhibition_id' => $segments[1],
                            'exhibition_history' => $exhibition['exhibition_history'],
                        ];
                    }
                }
            }
        }
        $this->info("- Found: {$matchCount} urls");
    }

    protected function saveToCsv()
    {
        $path = storage_path('app/exhibition_history-'.now()->format('Y-m-d-His').'.csv');
        $csv = fopen($path, 'w');
        fwrite($csv, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
        fputcsv($csv, ['artwork_id', 'exhibition_id', 'exhibition_history']);
        foreach (collect($this->exhibitions) as $exhibition) {
            fputcsv($csv, [
                (int) $exhibition['artwork_id'],
                (int) $exhibition['exhibition_id'],
                addslashes($exhibition['exhibition_history']),
            ]);
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
}
