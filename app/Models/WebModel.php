<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\ElasticSearchable;

/**
 * A base model for Web CMS resources
 */
class WebModel extends BaseModel
{

    use ElasticSearchable;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected static $source = 'Web';

    public static $sourceLastUpdateDateField = 'last_updated';

}
