<?php

namespace App\Transformers\Outbound;

use App\Transformers\Outbound\Collections\Traits\HasLakeFields;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class CollectionsTransformer extends BaseTransformer
{

    /**
     * This is a temporary shortcut. Make this exclusive to Assets once
     * the migration to CITI's API is complete.
     */
    use HasLakeFields;

}
