<?php

namespace App\Console\Commands\Update;

use App\Models\Collections\Artwork;

use App\Console\Commands\AbstractImportCommand as BaseCommand;

class UpdateTerms extends BaseCommand
{

    protected $signature = 'update:terms';

    protected $description = "Update term data for artworks";


    public function handle()
    {

        $this->api = env('COLLECTIONS_DATA_SERVICE_URL');

        $this->import( 'Collections', Artwork::class, 'artworks' );

    }

    protected function getUrl( $endpoint, $page = 1, $limit = 1000 )
    {

        $url = parent::getUrl( $endpoint, $page, $limit );
        $url .= '&fli=citiUid,title,altTerm_uid,prefTerm_uid';
        $url .= '&flo=id,title,pref_term_ids,alt_term_ids';

        return $url;

    }

    protected function save( $datum, $model, $transformer )
    {

        $this->info("Importing #{$datum->id}: {$datum->title}");

        // TODO: When we make inbound transformers, provide a toggle between find() & findOrNew()
        $resource = $model::find( $datum->id );

        // For this one, we should ignore entities that don't exist here
        if( !$resource )
        {
            return;
        }

        // Here we do the sync...

        $pref_terms = collect( $datum->pref_term_ids ?? [] )->map( function( $term ) {
            return [
                ( 'TM-' . $term ) => [
                    'preferred' => true
                ]
            ];
        });

        $alt_terms = collect( $datum->alt_term_ids ?? [] )->map( function( $term ) {
            return [
                ( 'TM-' . $term ) => [
                    'preferred' => false
                ]
            ];
        });

        $terms = $pref_terms->concat( $alt_terms );

        $resource->terms()->sync($terms->collapse());

        // We don't need to save the artwork, but do re-index it
        $resource->searchable();

    }

}
