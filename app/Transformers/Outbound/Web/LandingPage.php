<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Web\Traits\HasSearchTags;
use App\Transformers\Outbound\Web\Page as BaseTransformer;

class LandingPage extends BaseTransformer
{
    use HasSearchTags;
}
