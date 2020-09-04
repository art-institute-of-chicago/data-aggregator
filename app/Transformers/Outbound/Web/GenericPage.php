<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Traits\HasSearchTags;

use App\Transformers\Outbound\Web\Page as BaseTransformer;

class GenericPage extends BaseTransformer
{

    use HasSearchTags;
}
