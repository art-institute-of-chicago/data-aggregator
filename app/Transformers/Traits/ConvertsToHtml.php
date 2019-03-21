<?php

namespace App\Transformers\Traits;

use League\CommonMark\CommonMarkConverter;

trait ConvertsToHtml
{

    private $htmlConverter;

    private function getHtmlConverter()
    {
        return $this->htmlConverter ?? $this->htmlConverter = new CommonMarkConverter([
            'renderer' => [
                'soft_break' => '<br>',
            ]
        ]);
    }

    private function convertToHtml($value)
    {

        return isset($value) ? $this->getHtmlConverter()->convertToHtml($value) : null;

    }

}
