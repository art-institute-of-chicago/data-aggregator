<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use marijnvdwerf\palette\Palette;

use App\Models\Collections\Image;

class ImagesColor extends Command
{

    protected $signature = 'images:color';

    protected $description = 'Determine dominant color for each image';

    public function handle()
    {

        ini_set("memory_limit", "-1");

        $files = Storage::files( 'images' );

        $files = collect( $files );

        // Ignore any file that's not a jpg
        $files = $files->filter( function( $file ) {
            return stripos(strrev($file), 'gpj.') === 0;
        });

        // Reduce the set for testing
        // $files = $files->slice( 0, 200 );

        // Place to target specific files for debug:
        // $files = [
        //     'images/3d473396-9994-c487-51a3-87c23132f0e5.jpg',
        //     'images/9eabaa4f-bfcd-0fc0-1ea2-dbc64a8b0761.jpg',
        // ];

        foreach( $files as $file )
        {

            // Skip touched files
            if( Storage::size( $file ) < 1 ) {
                continue;
            }

            $contents = Storage::get( $file );

            $manager = new ImageManager(array('driver' => 'imagick'));
            $image = $manager->make( $contents );

            try {
                $palette = Palette::generate( $image );
            } catch( \Exception $e ) {
                // TODO: Resolve [ErrorException]  max(): Array must contain at least one element
                // See vendor/marijnvdwerf/material-palette/src/Palette.php:81
                continue;
            }

            $swatches = [
                'vibrant' => $palette->getVibrantSwatch(),
                'vibrant_light' => $palette->getLightVibrantSwatch(),
                'vibrant_dark' => $palette->getDarkVibrantSwatch(),
                'muted' => $palette->getMutedSwatch(),
                'muted_light' => $palette->getLightMutedSwatch(),
                'muted_dark' => $palette->getDarkMutedSwatch(),
            ];

            // @TODO Tweak this for better results?
            $swatch = $swatches['vibrant'] ?? $swatches['muted'] ?? $swatches['vibrant_light'] ?? $swatches['muted_light'] ?? $swatches['vibrant_dark'] ?? $swatches['muted_dark'] ?? null;

            // I guess this might happen if the image is black-and-white?
            if( !$swatch ) {
                continue;
            }

            // Convert to HSL - better for searching w/ Elasticsearch:
            // https://dpb587.me/blog/2014/04/24/color-searching-with-elasticsearch.html
            $color = $swatch->getColor()->asHSLColor();

            // @TODO Consider using HSV instead
            $out = [
                'h' => floor( $this->normalize( $color->getHue() * 360, 0, 360 ) ),
                's' => floor( $this->normalize( $color->getSaturation() * 100, 0, 100 ) ),
                'l' => floor( $this->normalize( $color->getLightness() * 100, 0, 100 ) ),
            ];

            // Assumes that the folder is `images`
            $id = substr( $file, 7, strlen( $file ) - 11 );

            // Save the color to Image metadata
            $image = Image::find( $id );

            // Image not found
            if( !$image ) {
                continue;
            }

            $metadata = $image->metadata ?? (object) [];
            $metadata->color = $out;

            $image->metadata = $metadata;
            $image->save();

            $this->info( $id . ' = ' . json_encode( $out ) );

        }

    }

    /**
     * Normalizes any number to an arbitrary range by assuming the range
     * wraps around when going below min or above max.
     *
     * @link https://stackoverflow.com/questions/1628386/normalise-orientation-between-0-and-360
     */
    private function normalize( $value, $min, $max )
    {
        $range = $max - $min;
        $offset = $value - $min;

        // + start to reset back to start of original range
        return ( $offset - ( floor( $offset / $range ) * $range ) ) + $min;
    }

}
