<?php

namespace App\Transformers\Traits;

use League\CommonMark\CommonMarkConverter;

trait ConvertsToHtml
{

    private $htmlConverter;

    /**
     * TODO: Consider moving this into a MarkdownServiceProvider?
     */
    private function getHtmlConverter()
    {
        return $this->htmlConverter ?? $this->htmlConverter = new CommonMarkConverter([
            'renderer' => [
                'soft_break' => '<br>',
            ],
        ]);
    }

    /**
     * This function takes a field that may or may not be HTML, and converts it to HTML
     * using CommonMark rules. Use for standardizing mixed-format fields for places that
     * expect HTML output.
     */
    private function convertToHtml($value)
    {
        return isset($value) ? $this->getHtmlConverter()->convertToHtml($value) : null;
    }
}
