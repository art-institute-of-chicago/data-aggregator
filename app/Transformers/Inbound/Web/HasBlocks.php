<?php

namespace App\Transformers\Inbound\Web;

use Illuminate\Support\Collection;

use App\Transformers\Datum;

trait HasBlocks
{

    protected function getExtraFields( Datum $datum )
    {

        $blocks = $this->getBlocks( $datum );

        return [
            'copy' => $this->getCopy( $blocks ),
            'imgix_uuid' => $this->getImage( $blocks ),
        ];

    }

    /**
     * Helper to retrieve sorted blocks, for concatenation.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getBlocks( Datum $datum )
    {

        // Articles use `copy`, but pages use `content`
        $field = $datum->copy ?? $datum->content ?? [];

        // Ensure blocks are sorted by their position
        $blocks = array_sort( $field, function( $block ) {
            return $block->position;
        });

        // Return as Laravel collection for convenience
        return collect( $blocks );

    }

    /**
     * Helper to retrieve article copy as one string.
     *
     * @return string
     */
    private function getCopy( Collection $blocks )
    {

        // Keep only filled-out paragraph blocks
        $blocks = $blocks->filter( function( $block ) {
            return $block->type == 'paragraph' && isset( $block->content->paragraph );
        });

        // Ensure there's valid paragraphs here
        if( $blocks->count() < 1 )
        {
            return null;
        }

        // Extract the paragraphs
        $paragraphs = $blocks->map( function( $block ) {
            return strip_tags( $block->content->paragraph );
        });

        // Return all paragraphs as one string
        return $paragraphs->implode(' ');

    }

    /**
     * Helper to retrieve preferred image.
     *
     * @return string
     */
    private function getImage( Collection $blocks )
    {

        // Get a URL to the first large image
        return $blocks->firstWhere('type', 'image')->medias[0]->uuid ?? null;

    }

}
