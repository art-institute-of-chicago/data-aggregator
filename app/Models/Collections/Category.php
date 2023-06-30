<?php

namespace App\Models\Collections;

/**
 * Tag-like classifications of artworks and other resources.
 */
class Category extends CategoryTerm
{
    protected static $isCategory = true;
}
