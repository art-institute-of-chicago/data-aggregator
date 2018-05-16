<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Documentable;
use App\Models\ElasticSearchable;

/**
 * A base model for Web CMS resources
 */
class WebModel extends BaseModel
{

    use Documentable, ElasticSearchable;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected static $source = 'Web';

    public static $sourceLastUpdateDateField = 'last_updated';

    protected function getMappingForDates()
    {

        if (!$this->hasSourceDates)
        {
            return [];
        }

        $ret = parent::getMappingForDates();

        // We need to replace the `doc` and `value of an item already in the array
        // This is tricky since we don't key by the field name
        // We should consider doing so once this logic lives in outbound transformers
        foreach ($ret as &$field) {
            if($field['name'] == 'last_updated_source') {
                $field['doc'] = "Date and time the resource was updated on the website";
                $field['value'] = function() { return $this->source_modified_at ? $this->source_modified_at->toIso8601String() : NULL; };
            }
        }

        return $ret;

    }
}
