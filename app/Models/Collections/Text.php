<?php

namespace App\Models\Collections;

/**
 * Text that represents a collections resource, like an artwork, artist, exhibition, etc.
 */
class Text extends Asset
{

    protected $table = 'assets';

    protected static $assetType = 'text';

}
