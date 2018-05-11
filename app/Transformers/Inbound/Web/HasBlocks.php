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

        // Get our rules for extracting copy from blocks
        $rules = $this->getCopyRules();

        // Loop through the rules to see which apply
        $texts = $blocks->map( function( $block ) use ( $rules ) {

            foreach( $rules as $rule )
            {
                if( $rule['filter']($block) )
                {
                    return $rule['extract']($block);
                }
            }

            return null;

        });

        // Filter out any null texts
        $texts = $texts->filter();

        // Ensure there's valid texts here
        if( $texts->count() < 1 )
        {
            return null;
        }

        // Return all texts as one string
        return $texts->implode(' ');

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

    /**
     * A place to define rules for identifying blocks with eligible copy, and for extracting
     * that copy. Used in the `getCopy` method. Has to be a function, not a class property.
     *
     * @var array
     */
    private function getCopyRules() {

        return [
            [
                'filter' => function( $block ) {
                    return $block->type == 'paragraph' && isset( $block->content->paragraph );
                },
                'extract' => function( $block ) {
                    return strip_tags( $block->content->paragraph );
                },
            ],
            [
                'filter' => function( $block ) {
                    return $block->type == 'artworks' && isset( $block->content->subhead );
                },
                'extract' => function( $block ) {
                    return strip_tags( $block->content->subhead );
                },
            ]
        ];

    }

}
