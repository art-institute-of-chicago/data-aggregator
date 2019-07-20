<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Artwork;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportAltText extends BaseCommand
{

    protected $signature = 'report:alt-text';

    protected $description = "Report all artworks and images that have visual descriptions";


    public function handle()
    {

        $csv = Writer::createFromString('');

        $csv->insertOne([
            'artwork_id',
            'artwork_citi_url',
            'artwork_lakeshore_url',
            'image_id',
            'image_lakeshore_url',
            'alt_text',
        ]);

        $artworks = Artwork::whereHas('assets', function ($query) {

            $query->whereNotNull('alt_text');

        })->cursor();

        foreach( $artworks as $artwork ) {

            foreach( $artwork->images as $image ) {

                if( $image->alt_text ) {

                    $row = [
                        'artwork_id' => $artwork->citi_id,
                        'artwork_citi_url' => env('CITI_ARTWORK_URL') . $artwork->citi_id,
                        'artwork_lakeshore_url' => $this->getLakeShoreLink( $artwork->lake_guid, 'works' ),
                        'image_id' => $image->lake_guid,
                        'image_lakeshore_url' => $this->getLakeShoreLink( $image->lake_guid, 'generic_works' ),
                        'alt_text' => $image->alt_text
                    ];

                    $csv->insertOne($row);

                }

            }

        }

        Storage::put('artwork-alt-tags.csv', $csv->getContent());

    }

    private function getLakeShoreLink($guid, $type) {

        return env('LAKESHORE_URL')
            . '/' . $type
            . '/' . $guid;

    }

}
