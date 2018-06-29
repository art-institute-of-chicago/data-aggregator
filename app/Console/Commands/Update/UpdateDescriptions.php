<?php

namespace App\Console\Commands\Update;

use App\Models\Collections\Artwork;
use App\Transformers\Inbound\Collections\Artwork as ArtworkTransformer;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class UpdateDescriptions extends BaseCommand
{

    protected $signature = 'update:descriptions {artwork_id?}';

    protected $description = "Standardizes artworks' styled web description to HTML";


    public function handle()
    {

        $id = $this->argument('artwork_id');

        $artworks = $id ? collect([Artwork::find( $id )]) : Artwork::whereNotNull('description')->cursor();

        foreach( $artworks as $artwork ) {

            $artwork->description = ArtworkTransformer::getDescription( $artwork->description );;
            $artwork->save();

            $this->info( "Updated #{$artwork->id}: {$artwork->title}" );

        }

    }

}
