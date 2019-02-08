<?php

namespace App\Transformers\Inbound\Collections;

use Illuminate\Database\Eloquent\Model;

use League\CommonMark\CommonMarkConverter;

use App\Models\Collections\ArtworkDate;
use App\Models\Collections\Gallery;

use App\Transformers\Datum;
use App\Transformers\Inbound\CollectionsTransformer;

use Carbon\Carbon;

class Artwork extends CollectionsTransformer
{

    protected function getExtraFields( Datum $datum )
    {

        // TODO: This is supposed to be a string, not an array...
        $copyright_notice = is_array( $datum->copyright ) ? $datum->copyright[0] : $datum->copyright;

        // Standarize HTML/non-HTML descriptions
        $description = self::getDescription( $datum->description );

        return [
            'description' => $description,
            'alt_titles' => $datum->alt_titles,
            'artist_display' => $datum->creator_display,
            'medium_display' => $datum->medium,
            'publication_history' => $datum->publications,
            'exhibition_history' => $datum->exhibitions,
            'copyright_notice' => $copyright_notice,
            'gallery_citi_id' => $datum->gallery_id,
            // TODO: ArtworkTypes may need to be attached via string comparison
            //'artwork_type_citi_id' => , // Redmine #2431
        ];

    }

    protected function getSync( Datum $datum, $test = false )
    {

        return [

            'images'        => $this->getSyncImages( $datum ),
            'documents'     => $this->getSyncDocuments( $datum ),
            'categories'    => $this->getSyncCategories( $datum ),
            'terms'         => $this->getSyncTerms( $datum ),

            'artists'       => $this->getSyncArtists( $datum ),
            'places'        => $this->getSyncPlaces( $datum ),
            'catalogues'    => $this->getSyncCatalogues( $datum ),

        ];

    }

    // TODO: Ensure that removing gallery.type update is kosher
    public function syncEx( Model $instance, Datum $datum )
    {

        $this->syncDates( $instance, $datum );

    }

    /**
     * This function takes a field that may or may not be HTML, and converts it to HTML
     * using CommonMark rules. Use for standardizing mixed-format fields for places that
     * expect HTML output.
     *
     * This method is public for use in \App\Console\Commands\Update\UpdateAssets
     *
     * @TODO: Consider moving this higher up in the class hierarchy or to a helper?
     */
    public static function getDescription( $description )
    {

        $converter = new CommonMarkConverter([
            'renderer' => [
                'soft_break' => '<br>',
            ]
        ]);

        $description = $converter->convertToHtml($description);

        return $description;

    }

    /**
     * Attach artwork images – both preferred, and alternative.
     * Differentiate representations from documentation.
     *
     * @TODO: Shared logic w/ exhibitions - abstract?
     */
    private function getSyncImages( Datum $datum )
    {

        // Start building the image sync by adding alts first
        $images = collect( $datum->alt_image_guids )->map( function( $image ) {
            return [
                $image => [
                    'preferred' => false,
                    'is_doc' => false,
                ]
            ];
        });

        // Add the preferred representation, if it's available
        if ($datum->image_guid)
        {

            $images->push([
                $datum->image_guid => [
                    'preferred' => true,
                    'is_doc' => false,
                ]
            ]);

        }

        // Collapse a collection of arrays into a single, flat collection
        $images = $images->collapse();

        return $images;

    }

    /**
     * Get an artwork's documentary assets for syncing.
     *
     * @param \App\Transformers\Datum $datum
     * @return array
     */
    private function getSyncDocuments( Datum $datum )
    {

        $documents = collect( $datum->document_ids )->map( function( $document ) {
            return [
                $document => [
                    'preferred' => false,
                    'is_doc' => true,
                ]
            ];
        });

        $documents = $documents->collapse();

        return $documents;

    }

    /**
     * Get an artwork's publish categories for syncing.
     *
     * @param \App\Transformers\Datum $datum
     * @return array
     */
    private function getSyncCategories( Datum $datum )
    {

        $categories = collect( $datum->category_ids )->map( function( $id ) {
            return 'PC-' . $id;
        });

        return $categories;

    }

    /**
     * Get an artwork's index terms for syncing.
     *
     * @param \App\Transformers\Datum $datum
     * @return array
     */
    private function getSyncTerms( Datum $datum )
    {

        $pref_terms = collect( $datum->pref_term_ids )->map( function( $term_id ) {
            return [
                ( 'TM-' . $term_id ) => [
                    'preferred' => true
                ]
            ];
        });

        $alt_terms = collect( $datum->alt_term_ids )->map( function( $term_id ) {
            return [
                ( 'TM-' . $term_id ) => [
                    'preferred' => false
                ]
            ];
        });

        $terms = $pref_terms->concat( $alt_terms );
        $terms = $terms->collapse();

        return $terms;

    }

    /**
     * Get an artwork's agents and their roles for syncing.
     *
     * @param \App\Transformers\Datum $datum
     * @return array
     */
    private function getSyncArtists( Datum $datum )
    {

        // Worst case: no pivots, nor basic artist
        if( !$datum->artwork_agents && !$datum->creator_id )
        {
            return [];
        }

        // No pivots, but basic artist
        if( !$datum->artwork_agents && $datum->creator_id )
        {
            // In migrations, we default `preferred` to true and `agent_role_citi_id` to 219
            return [ $datum->creator_id ];
        }

        return $this->getSyncPivots( $datum, 'artwork_agents', 'agent_id', function( $pivot ) {

            return [
                $pivot->agent_id => [
                    'agent_role_citi_id' => $pivot->role_id,
                    'preferred' => $pivot->is_preferred,
                ]
            ];

        });

    }

    /**
     * Attach artwork places, and what happened to the artwork in each place.
     *
     * @TODO Waiting on Redmine #2847 – place normalization for non-"Web Everything" works
     *
     * @param \App\Transformers\Datum $datum
     * @return array
     */
    private function getSyncPlaces( Datum $datum )
    {

        return $this->getSyncPivots( $datum, 'artwork_places', 'place_id', function( $pivot ) {

            return [
                $pivot->place_id => [
                    'artwork_place_qualifier_citi_id' => $pivot->place_qualifier_id,
                    'preferred' => $pivot->is_preferred,
                ]
            ];

        });

    }

    /**
     * Attach catalogue raisonnes within which this artwork was published.
     */
    private function getSyncCatalogues( Datum $datum )
    {

        return $this->getSyncPivots( $datum, 'artwork_catalogues', 'catalog_id', function( $pivot ) {

            return [
                $pivot->catalog_id => [
                    'citi_id' => $pivot->citi_id, // TODO: Make this incremental?
                    'number' => $pivot->number,
                    'state_edition' => $pivot->state_edition,
                    // 'catalogue_citi_id' => $pivot->catalog_id, // TODO: Verify?
                    'preferred' => (bool) $pivot->is_preferred,
                ]
            ];

        });

    }

    /**
     * Attach dates to an artwork.
     */
    private function syncDates( Model $instance, Datum $datum )
    {

        $instance->dates()->delete();

        if (!$datum->artwork_dates)
        {
            return;
        }

        foreach ( ($datum->artwork_dates ?? []) as $date)
        {
            ArtworkDate::create([
                // TODO: Use automatic id so that we can create parity b/w web-basic and web-everything?
                'citi_id' => $date->id,
                'artwork_citi_id' => $datum->citi_id, // draw from the artwork record
                'lake_guid' => $date->lake_guid,
                'date_earliest' => Carbon::parse($date->date_earliest),
                'date_latest' => Carbon::parse($date->date_latest),
                'preferred' => $date->is_preferred,
                'artwork_date_qualifier_citi_id' => $date->date_qualifier_id,
            ]);
        }

    }

}
