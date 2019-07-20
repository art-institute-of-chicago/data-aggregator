<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Artwork;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportArtistDisplay extends BaseCommand
{

    public static $filename = 'artwork-artist-display-linebreaks.csv';

    protected $signature = 'report:artist-display';

    protected $description = "Breakdown artworks based on number of linebreaks in artist_display";

    protected $csv;

    public function handle()
    {

        // Not an ideal solution, but some models are really heavy
        ini_set("memory_limit", "-1");

        $this->csv = Writer::createFromPath($this->getCsvPath(), 'w');

        $this->csv->insertOne([
            'number_of_linebreaks',
            'number_of_artworks',
        ]);

        $results = [];

        // Currently, 11 linebreaks is the record
        for ($i = 1; $i < 12; $i++) {

            $narr = array_fill(0, $i, '\n');
            $nstr = implode('[^\n]*', $narr);

            $artworks = Artwork::whereRaw('artist_display REGEXP "^[^\n]*' . $nstr . '[^\n]*$"');

            $count = $artworks->count();

            $results[] = [
                'number_of_linebreaks' => $i,
                'number_of_artworks' => $count,
            ];

        }

        // Special case for zero newlines
        array_unshift($results, [
            'number_of_linebreaks' => 0,
            'number_of_artworks' => Artwork::whereRaw('artist_display NOT REGEXP "\n"')->count(),
        ]);

        // Special case for no artist display
        array_unshift($results, [
            'number_of_linebreaks' => null,
            'number_of_artworks' => Artwork::whereNull('artist_display')->count(),
        ]);

        $this->warn('Total artworks: ' . collect($results)->sum('number_of_artworks'));

        foreach($results as $result) {
            $this->insertOne($result['number_of_linebreaks'], $result['number_of_artworks']);
        }

    }

    private function insertOne($numberOfLinebreaks, $numberOfArtworks)
    {
        $row = [
            'number_of_linebreaks' => $numberOfLinebreaks,
            'number_of_artworks' => $numberOfArtworks,
        ];

        $this->info($numberOfLinebreaks . ' linebreaks occur in ' . $numberOfArtworks . ' artworks.');

        $this->csv->insertOne($row);
    }

    private function getCsvPath()
    {

        return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . self::$filename;

    }

}
