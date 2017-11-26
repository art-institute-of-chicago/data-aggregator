<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use League\Csv\Reader;

use App\Models\Collections\Image;

class ImagesImport extends Command
{

    protected $signature = 'images:import';

    protected $description = 'Import CSV for downloaded images';

    protected $filename = 'output.csv';

    public function handle()
    {

        ini_set("memory_limit", "-1");

        $path = storage_path() . '/app/' . $this->filename;

        $csv = Reader::createFromPath( $path, 'r' );
        $csv->setHeaderOffset(0);

        foreach( $csv->getRecords() as $row )
        {

            // Save to Image metadata
            $image = Image::find( $row['id'] );

            // Image not found
            if( !$image ) {
                continue;
            }

            $metadata = $image->metadata ?? (object) [];
            $fingerprint = $metadata->fingerprint ?? (object) [];

            $fingerprint->ahash = $row['ahash'] ?? null;
            $fingerprint->dhash = $row['dhash'] ?? null;
            $fingerprint->phash = $row['phash'] ?? null;
            $fingerprint->whash = $row['whash'] ?? null;

            $metadata->mse = $row['mse'] ?? null;

            $metadata->fingerprint = $fingerprint;
            $image->metadata = $metadata;

            $image->save();

            // Output for reference
            $this->info( $image->getKey() . ' = ' . implode(', ', [
                $image->metadata->mse,
                $image->metadata->fingerprint->ahash,
                $image->metadata->fingerprint->dhash,
                $image->metadata->fingerprint->phash,
                $image->metadata->fingerprint->whash,
            ]));

        }

    }

}
