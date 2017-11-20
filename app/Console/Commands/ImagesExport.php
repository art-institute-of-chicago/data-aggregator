<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use League\Csv\Writer;
use League\Csv\Reader;

class ImagesExport extends Command
{

    protected $signature = 'images:export';

    protected $description = 'Export CSV for downloaded images';

    protected $filename = 'input.csv';

    protected $csv;

    public function handle()
    {

        ini_set("memory_limit", "-1");

        $files = Storage::files( 'images' );
        $files = collect( $files );

        // Ignore any file that's not a jpg
        $files = $files->filter( function( $file ) {
            return stripos(strrev($file), 'gpj.') === 0;
        });

        $out = $files->map( [$this, 'getRow'] );

        $path = storage_path() . '/app/' . $this->filename;

        $this->csv = Writer::createFromPath( $path, 'w' );
        $this->csv->insertOne( ['id', 'is_downloaded', 'last_attempted'] );
        $this->csv->insertAll( $out );

    }

    public function getRow( $file )
    {

        return [
            'id' => pathinfo( storage_path() . '/' . $file, PATHINFO_FILENAME ),
            'is_downloaded' => Storage::size( $file ) > 0,
            'last_attempt_at' => Storage::lastModified( $file ),
        ];

    }

}
