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

}
