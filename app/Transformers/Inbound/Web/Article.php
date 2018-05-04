<?php

namespace App\Transformers\Inbound\Web;

use Illuminate\Support\Collection;

use App\Transformers\Datum;
use App\Transformers\Inbound\AbstractTransformer;

class Article extends AbstractTransformer
{

    protected function getTitle( Datum $datum )
    {

        return [
            'title' => $datum->slug,
        ];

    }

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

        // Ensure blocks are sorted by their position
        $blocks = array_sort( $datum->copy, function( Datum $block ) {
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
        $blocks = $blocks->filter( function( Datum $block ) {
            return $block->type == 'paragraph' && isset( $block->content->paragraph );
        });

        // Extract the paragraphs
        $paragraphs = $blocks->map( function( Datum $block ) {
            return $block->content->paragraph;
        });

        // Return all paragraphs as one string
        return $paragraphs->implode('');

    }

    /**
     * Helper to retrieve preferred image.
     *
     * @return string
     */
    private function getImage( Collection $blocks )
    {

        // Get a URL to the first large image
        return $blocks->firstWhere('type', 'image')->medias[0]->uuid;

    }

}
