<?php

namespace App\Models;

/**
 * A base model for Web CMS resources
 */
class WebModel extends BaseModel
{

    use ElasticSearchable;

    public static $sourceLastUpdateDateField = 'last_updated';

    protected static $source = 'Web';

    protected $casts = [
        'published' => 'boolean',
    ];

}
