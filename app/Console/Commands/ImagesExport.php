<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use League\Csv\Writer;

use App\Models\Collections\Image;

class ImagesExport extends Command
{

    protected $signature = 'images:export';

    protected $description = 'Export CSV for image metadata';

    protected $filename = 'images.csv';

    protected $csv;

    public function handle()
    {

        ini_set("memory_limit", "-1");

        $path = storage_path() . '/app/' . $this->filename;

        $this->csv = Writer::createFromPath( $path, 'w' );
        $this->csv->insertOne( ['id', 'h', 's', 'l', 'population', 'percentage'] );

        $images = Image::whereNotNull('metadata')->get();

        $this->info( $images->count() . ' images with metadata found.', 'vv' );

        // Uncomment for testing
        // $images = $images->slice( 0, 5 );

        $images->map( [$this, 'getRow'] );

    }

    public function getRow( $image )
    {

        $row = [
            'id' => $image->getKey(),
            'h' => $image->metadata->color->h ?? null,
            's' => $image->metadata->color->s ?? null,
            'l' => $image->metadata->color->l ?? null,
            'population' => $image->metadata->color->population ?? null,
            'percentage' => $image->metadata->color->percentage ?? null,
        ];

        $this->csv->insertOne( $row );

        $this->info( json_encode( $row ), 'vv' );

    }

}
