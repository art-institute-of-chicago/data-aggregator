<?php

namespace App\Models\Collections;

/**
 * Represents a term/tag on an artwork. In the API, this includes styles, classifications and subjects.
 * Terms are meant to be more specific than publish categories, and is a taxonomy taken from Getty AAT.
 */
class Term extends CategoryTerm
{

    protected static $isCategory = false;
}
