<?php

namespace App\Models;

/**
 * A base model for Web CMS resources
 */
class WebModel extends BaseModel
{

    use ElasticSearchable;

    protected static $source = 'Web';

    protected $casts = [
        'published' => 'boolean',
    ];
}
