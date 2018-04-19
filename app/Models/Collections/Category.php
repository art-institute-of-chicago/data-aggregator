<?php

namespace App\Models\Collections;

use App\Models\Documentable;

/**
 * Tag-like classifications of artworks and other resources.
 */
class Category extends CategoryTerm
{

    use Documentable;

    protected static $isCategory = true;


    public function getExtraFillFieldsFrom($source)
    {

        return [
            'parent_id' => $source->parent_id ? 'PC-' . $source->parent_id : null,
            'subtype' => $source->type ? 'CT-' . $source->type : null,
        ];

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "PC-3";

    }

}
