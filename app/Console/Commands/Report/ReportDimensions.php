<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Artwork;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportDimensions extends BaseCommand
{

    public static $filename = 'artwork-dimensions.csv';

    protected $signature = 'report:dimensions';

    protected $description = 'Report all artworks that have no preferred images set';

    protected $csv;

    public function handle()
    {
        $this->csv = Writer::createFromPath($this->getCsvPath(), 'w');

        $this->csv->insertOne([
            'id',
            'dimensions',
        ]);

        $artworks = Artwork::select('citi_id', 'dimensions')->whereNotNull('dimensions');

        foreach ($artworks->cursor() as $artwork) {
            $this->insertOne($artwork);
        }
    }

    private function insertOne($artwork)
    {
        $row = [
            'id' => $artwork->citi_id,
            'dimensions' => $artwork->dimensions,
        ];

        $this->info(implode(',', $row));

        $this->csv->insertOne($row);
    }

    private function getCsvPath()
    {
        return Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . self::$filename;
    }

}
