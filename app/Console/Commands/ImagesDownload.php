<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Collections\Image;

class ImagesDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloads all images from LAKE IIIF';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        ini_set("memory_limit", "-1");

        $lastSkipFile = 'lastImageSkip.txt';

        // Determine our $skip from last time
        if( \Storage::exists( $lastSkipFile ) ) {
            $skip = (int) \Storage::get( $lastSkipFile );
        } else {
            $skip = 0;
        }

        $count = Image::count();
        $take = 10;

        while( $skip < $count ) {

            // https://stackoverflow.com/questions/35643192/laravel-eloquent-limit-and-offset
            $ids = Image::skip( $skip )->take( $take )->get(['lake_guid'])->pluck('lake_guid');

            $ids->each( function( $id, $i ) use ( $skip ) {

                $n = $i + $skip;
                $file = "images/{$id}.jpg";
                $url = env('IIIF_URL') . "/{$id}/full/!800,800/0/default.jpg";

                // Check if file exists
                $exists = \Storage::exists( $file );

                if( $exists ) {
                    $this->warn( "Image #{$n}: ID {$id} - already exists" );
                    return;
                }

                try {
                    $contents = $this->fetch( $url );
                    \Storage::put( $file, $contents);
                    $this->info( "Image #{$n}: ID {$id} - downloaded" );
                }
                catch (\Exception $e) {
                    $this->line( "Image #{$n}: ID {$id} - not found" );
                    return;
                }


            });

            // Advance our counter
            $skip += $take;

            \Storage::put( $lastSkipFile, $skip );

        }

    }

    private function fetch( $file ) {

        if( !$contents = @file_get_contents( $file ) )
        {
            throw new \Exception('Load Failed');
        }

        return $contents;

    }

}
