<?php

namespace App\Transformers\Traits;

use League\CommonMark\MarkdownConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;

trait ConvertsToHtml
{
    private $htmlConverter;
    private $config = [
        'renderer' => [
            'soft_break' => '<br>',
        ],
    ];

    private function getEnvironment()
    {
        $environment = new Environment($this->config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());
        return $environment;
    }

    private function getHtmlConverter()
    {
        return $this->htmlConverter ?? $this->htmlConverter = new MarkdownConverter($this->getEnvironment());
    }

    /**
     * This function takes a field that may or may not be HTML, and converts it to HTML
     * using CommonMark rules. Use for standardizing mixed-format fields for places that
     * expect HTML output.
     */
    private function convertToHtml($value)
    {
        return isset($value) ? $this->getHtmlConverter()->convertToHtml($value)->getContent() : null;
    }
}
