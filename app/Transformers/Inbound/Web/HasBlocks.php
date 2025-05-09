<?php

namespace App\Transformers\Inbound\Web;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Transformers\Datum;

trait HasBlocks
{
    protected function getExtraFields(Datum $datum)
    {
        // Articles use `copy`, but pages use `content`
        $contents = $datum->copy ?? $datum->content ?? [];

        // Digital publications provide a ready-made string
        if (is_string($contents)) {
            return [
                'copy' => $contents,
            ];
        }

        $blocks = $this->getBlocks($contents);

        return [
            'copy' => $this->getCopy($blocks),
        ];
    }

    /**
     * Helper to retrieve sorted blocks, for concatenation.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getBlocks(array $contents)
    {
        // Ensure blocks are sorted by their position
        $blocks = Arr::sort($contents, function ($block) {
            return $block->position;
        });

        // Return as Laravel collection for convenience
        return collect($blocks);
    }

    /**
     * Helper to retrieve article copy as one string.
     *
     * @return ?string
     */
    private function getCopy(Collection $blocks)
    {
        // Get our rules for extracting copy from blocks
        $rules = $this->getCopyRules();

        // Loop through the rules to see which apply
        $texts = $blocks->map(function ($block) use ($rules) {
            foreach ($rules as $rule) {
                if ($rule['filter']($block)) {
                    return $rule['extract']($block);
                }
            }

            return null;
        });

        // Filter out any null texts
        $texts = $texts->filter();

        // Ensure there's valid texts here
        if ($texts->count() < 1) {
            return null;
        }

        // Return all texts as one string
        return $texts->implode(' ');
    }

    /**
     * A place to define rules for identifying blocks with eligible copy, and for extracting
     * that copy. Used in the `getCopy` method. Has to be a function, not a class property.
     *
     * @return array
     */
    private function getCopyRules()
    {
        return [
            [
                'filter' => function ($block) {
                    return $block->type === 'paragraph' && isset($block->content->paragraph);
                },
                'extract' => function ($block) {
                    return $this->cleanRichText($block->content->paragraph);
                },
            ],
            [
                'filter' => function ($block) {
                    return $block->type === 'artworks' && isset($block->content->subhead);
                },
                'extract' => function ($block) {
                    return $this->cleanRichText($block->content->subhead);
                },
            ],
            [
                'filter' => function ($block) {
                    return ($block->type === 'showcase' || $block->type === 'grid_item' || $block->type === 'showcase_item')
                            && isset($block->content->title) && isset($block->content->description);
                },
                'extract' => function ($block) {
                    return trim($this->cleanRichText($block->content->title)) . ". " . trim($this->cleanRichText($block->content->description));
                },
            ],
            [
                'filter' => function ($block) {
                    return ($block->type === 'editorial_block' || $block->type === 'feature_block')
                            && isset($block->content->heading) && isset($block->content->body);
                },
                'extract' => function ($block) {
                    return trim($this->cleanRichText($block->content->heading)) . ". " . trim($this->cleanRichText($block->content->body));
                },
            ],
            [
                'filter' => function ($block) {
                    return ($block->type === 'showcase_multiple')
                            && isset($block->content->heading) && isset($block->content->intro);
                },
                'extract' => function ($block) {
                    return trim($this->cleanRichText($block->content->heading)) . ". " . trim($this->cleanRichText($block->content->intro));
                },
            ],
        ];
    }

    /**
     * Transforms our website's WYSIWYG output to searchable plaintext.
     *
     * @return string
     */
    private function cleanRichText(string $content)
    {
        // PHP's `strip_tags` has no way to replace tags with spaces
        $content = preg_replace('#<[^>]+>#', ' ', $content);

        // Decode HTML entities, but simplify &nbsp; to normal spaces
        $content = str_replace('&nbsp;', ' ', $content);
        $content = html_entity_decode($content);

        // Collapse multiple spaces into one
        $content = preg_replace('/\s+/', ' ', $content);

        return $content;
    }
}
