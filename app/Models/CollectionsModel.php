<?php

namespace App\Models;

use App\Models\BaseModel;

class CollectionsModel extends BaseModel
{

    protected static $source = 'Collections';
    protected $fakeIdsStartAt = 999000000;

    /**
     * Get the class name for a given API endpoint
     *
     * @param  string  $endpoint
     * @return string
     */
    public static function classFor($endpoint)
    {

        switch ($endpoint) {
            case 'artists':
                return \App\Models\Collections\Agent::class;
            break;
            case 'venues':
                return \App\Models\Collections\Agent::class;
            break;
            case 'exhibition-agents':
                return \App\Models\Collections\AgentExhibition::class;
            break;
        }

        return parent::classFor($endpoint);

    }


    /**
     * Fill in this model's IDs from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillIdsFrom($source)
    {

        $fill = [];

        if ($this->getKeyName() == 'citi_id')
        {

            $fill['citi_id'] = $source->id;
            $fill['lake_guid'] = $source->lake_guid;

        }
        else
        {

            $fill['lake_guid'] = $source->id;

        }

        $fill['lake_uri'] = $source->lake_uri;

        $this->fill($fill);

        return $this;

    }


    /**
     * Fill in this model's dates from the given resource, or fill it in with fake data.
     * This method is used primarily when the given resource is provided by the source
     * system.
     *
     * @param  object  $source
     * @return $this
     */
    protected function fillDatesFrom($source)
    {

        $fill = [];

        $fill['source_created_at'] = strtotime($source->created_at);
        $fill['source_modified_at'] = strtotime($source->modified_at);
        $fill['source_indexed_at'] = strtotime($source->indexed_at);

        $this->fill($fill);

        return $this;

    }

    /**
     * Define how the fields in the API are mapped to model properties.
     *
     * Acts as a wrapper method to common attributes across a range of resources. Each method should
     * override `transformMappingInternal()` with their specific field definitions.
     *
     * The keys in the returned array represent the property name as it appears in the API. The value of
     * each pair is an array that includes the following:
     *
     * - "doc" => The documentation for this API field
     * - "value" => An anoymous function that returns the value for this field
     *
     * @return array
     */
    protected function transformMapping()
    {

        $ret = [
            [
                "name" => 'id',
                'doc' => "Unique identifier of this resource. Taken from the source system",
                "type" => "number",
                'value' => function() { return $this->getAttributeValue($this->getKeyName()); },
            ],
            [
                "name" => 'title',
                'doc' => "Name of this resource",
                "type" => "string",
                'value' => function() { return $this->title; },
            ]
        ];

        if ($this->citiObject)
        {

            $ret = array_merge($ret,
                               [
                                   [
                                       "name" => 'lake_guid',
                                       'doc' => "Unique UUID of this resource in LAKE, our digital asset management system",
                                       "type" => "uuid",
                                       'value' => function() { return $this->lake_guid; },
                                   ]
                               ]
            );

        }

        $ret = array_merge($ret, $this->transformMappingInternal());

        if (!$this->excludeDates)
        {

            if ($this->citiObject)
            {

                $ret = array_merge($ret,
                                   [
                                       [
                                           "name" => 'last_updated_citi',
                                           'doc' => "Date and time the resource was updated in CITI, our collections management system",
                                           "type" => "ISO 8601 date and time",
                                           'value' => function() { return $this->citi_modified_at->toIso8601String(); },
                                       ]
                                   ]);

            }

            $ret = array_merge($ret,
                               [
                                   [
                                       "name" => 'last_updated_fedora',
                                       'doc' => "Date and time the resource was updated in LAKE, our digital asset management system",
                                       "type" => "ISO 8601 date and time",
                                       'value' => function() { return $this->source_modified_at ? $this->source_modified_at->toIso8601String() : NULL; },
                                   ],
                                   [
                                       "name" => 'last_updated_source',
                                       'doc' => "Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data",
                                       "type" => "string",
                                       'value' => function() { return $this->source_indexed_at ? $this->source_indexed_at->toIso8601String() : NULL; },
                                   ],
                                   [
                                       "name" => 'last_updated',
                                       'doc' => "Date and time the resource was updated in the Data Aggregator",
                                       "type" => "ISO 8601 date and time",
                                       'value' => function() { return $this->updated_at ? $this->updated_at->toIso8601String() : NULL; },
                                   ],
                               ]
            );

        }

        return $ret;

    }

}
