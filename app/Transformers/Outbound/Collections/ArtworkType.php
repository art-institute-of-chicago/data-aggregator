<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Traits\HasAatId;
use App\Transformers\Outbound\CollectionsCC0Transformer as BaseTransformer;

class ArtworkType extends BaseTransformer
{
    use HasAatId;
}
