<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use League\Csv\Reader;

use App\Models\Collections\Image;

class ImagesImport extends Command
{

    protected $signature = 'images:import';

    protected $description = 'Import CSV for image metadata';

    protected $filename = 'images.csv';

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

            $image->metadata = $this->getMetadata( $image, $row );

            $image->save();

            // Output for reference
            $this->info( $image->getKey() . ' = ' . json_encode( $image->metadata ) );

        }

    }

    private function getMetadata( $image, $row )
    {

        $metadata = $image->metadata ?? (object) [];

        $metadata->color = $this->getColor( $metadata, $row );
        // $metadata->fingerprint = $this->getFingerprint( $metadata, $row );

        // $metadata->mse = $row['mse'] ?? null;

        return $metadata;

    }

    private function getColor( $metadata, $row )
    {

        $color = $metadata->color ?? (object) [];

        $color->h = (int) $row['h'] ?? null;
        $color->s = (int) $row['s'] ?? null;
        $color->l = (int) $row['l'] ?? null;
        $color->population = (int) $row['population'] ?? null;
        $color->percentage = (float) $row['percentage'] ?? null;

        return $color;

    }

    private function getFingerprint( $metadata, $row )
    {

        $fingerprint = $metadata->fingerprint ?? (object) [];

        $fingerprint->ahash = $row['ahash'] ?? null;
        $fingerprint->dhash = $row['dhash'] ?? null;
        $fingerprint->phash = $row['phash'] ?? null;
        $fingerprint->whash = $row['whash'] ?? null;

        return $fingerprint;

    }

}
