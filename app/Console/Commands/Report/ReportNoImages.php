<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Artwork;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportNoImages extends BaseCommand
{

    protected $signature = 'report:no-images';

    protected $description = "Report all artworks that have no preferred images set";

    public static $filename = 'artwork-no-images.csv';

    protected $csv;


    public function handle()
    {

        // Not an ideal solution, but some models are really heavy
        ini_set("memory_limit", "-1");

        $this->csv = Writer::createFromPath( $this->getCsvPath(), 'w' );

        $this->csv->insertOne([
            'artwork_id',
            'main_reference_number',
            'title',
        ]);

        // The rest we'll have to filter manually for now
        $this->getArtworksWithoutPreferredImages();

        // Any artwork that doesn't have images automatically qualifies
        $this->getArtworksWithoutAnyImages();

    }

    private function getArtworksWithoutAnyImages()
    {
        $artworks = Artwork::whereDoesntHave('images');

        foreach ($artworks->cursor() as $artwork)
        {
            $this->insertOne( $artwork );
        }
    }

    private function getArtworksWithoutPreferredImages()
    {
        $artworks = Artwork::whereHas('images');

        foreach ($artworks->cursor() as $artwork)
        {
            if (!$artwork->image()) {
                $this->insertOne( $artwork );
            }
        }
    }

    private function insertOne($artwork)
    {
        $row = [
            'artwork_id' => $artwork->citi_id,
            'main_reference_number' => $artwork->main_id,
            'title' => $artwork->title,
        ];

        $this->csv->insertOne($row);
    }

    private function getCsvPath()
    {

        return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . self::$filename;

    }

}
