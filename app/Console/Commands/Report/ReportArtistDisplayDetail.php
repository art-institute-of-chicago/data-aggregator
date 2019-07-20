<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Artwork;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportArtistDisplayDetail extends BaseCommand
{

    protected $signature = 'report:artist-display-detail';

    protected $description = "Detailed breakdown of artworks by linebreak count in artist_display";

    public static $filename = 'artwork-artist-display-linebreaks-detail.csv';

    protected $csv;

    public function handle()
    {

        // Not an ideal solution, but some models are really heavy
        ini_set("memory_limit", "-1");

        $this->csv = Writer::createFromPath($this->getCsvPath(), 'w');

        $this->csv->insertOne([
            'number_of_linebreaks',
            'artwork_id',
            'title',
            'artist_display',
        ]);

        // Currently, 11 linebreaks is the record. Start with 6.
        for ($i = 6; $i < 12; $i++) {

            $narr = array_fill(0, $i, '\n');
            $nstr = implode('[^\n]*', $narr);

            $artworks = Artwork::whereRaw('artist_display REGEXP "^[^\n]*' . $nstr . '[^\n]*$"');

            foreach($artworks->get() as $artwork) {
                $this->insertOne($i, $artwork);
            }

        }

    }

    private function insertOne($numberOfLinebreaks, $artwork)
    {
        $row = [
            'number_of_linebreaks' => $numberOfLinebreaks,
            'artwork_id' => $artwork->citi_id,
            'title' => $artwork->title,
            'artist_display' => $artwork->artist_display,
        ];

        $this->info($numberOfLinebreaks . ' in artwork #' . $row['artwork_id'] . ' – ' . $row['title']);

        $this->csv->insertOne($row);
    }

    private function getCsvPath()
    {

        return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . self::$filename;

    }

}
