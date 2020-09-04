<?php

namespace App\Models\Collections;

/**
 * A moving image representation of a collections resource, like an artwork, artist, exhibition, etc.
 */
class Video extends Asset
{

    protected static $assetType = 'video';

    protected $table = 'assets';
}
