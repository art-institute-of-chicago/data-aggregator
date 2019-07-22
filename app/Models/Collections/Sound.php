<?php

namespace App\Models\Collections;

/**
 * Audio that represents a collections resource, like an artwork, artist, exhibition, etc.
 */
class Sound extends Asset
{

    protected static $assetType = 'sound';

    protected $table = 'assets';

}
