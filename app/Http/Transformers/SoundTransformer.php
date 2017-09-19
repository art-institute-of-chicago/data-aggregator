<?php

namespace App\Http\Transformers;

use App\Models\Collections\Sound;

class SoundTransformer extends AssetTransformer
{
    public $excludeDates = true;
}
