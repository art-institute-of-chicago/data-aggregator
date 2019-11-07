<?php

namespace App\Transformers\Outbound;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;
use App\Transformers\Outbound\Collections\Traits\IsCC0;

class CollectionsCC0Transformer extends BaseTransformer
{
    use IsCC0;
}
