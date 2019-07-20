<?php

namespace App\Console\Commands\Report;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportNoTerms extends BaseCommand
{

    protected $signature = 'report:no-terms';

    protected $description = "Report all artworks that have no Expore Further preferred terms set";

    public function handle()
    {

        $csv = Writer::createFromString('');

        $csv->insertOne([
            'artwork_id',
            'main_reference_number',
            'title',
            'classification_id',
            'style_id',
            'artist_id',
        ]);

        $response = file_get_contents(config('app.url') . '/api/v1/artworks/search?limit=500&query%5Bbool%5D%5Bmust_not%5D%5B%5D%5Bexists%5D%5Bfield%5D=style_id&query%5Bbool%5D%5Bmust_not%5D%5B%5D%5Bexists%5D%5Bfield%5D=classification_id&query%5Bbool%5D%5Bmust_not%5D%5B%5D%5Bexists%5D%5Bfield%5D=artist_id&fields=id,title,artist_id,classification_id,style_id,main_reference_number');

        foreach (json_decode($response)->data as $artwork)
        {

            $row = [
                'artwork_id' => $artwork->id,
                'main_reference_number' => $artwork->main_reference_number,
                'title' => $artwork->title,
                'classification_id' => $artwork->classification_id,
                'style_id' => $artwork->style_id,
                'artist_id' => $artwork->artist_id,
            ];

            $csv->insertOne($row);

        }

        Storage::put('artwork-no-terms.csv', $csv->getContent());

    }

}
