<?php

namespace App\Models;

use App\Models\BaseModel;

class CollectionsModel extends BaseModel
{

    protected static $source = 'Collections';
    protected $fakeIdsStartAt = 999000000;

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

        } else {

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

    protected function getMappingForIds()
    {

        $ret = parent::getMappingForIds();

        // TODO: I think this logic is wrong... It's the same as it was before, but it may need to be reversed
        if (!$this->citiObject)
        {
            return $ret;
        }

        return array_merge( $ret, [
            [
               "name" => 'lake_guid',
               'doc' => "Unique UUID of this resource in LAKE, our digital asset management system",
               "type" => "uuid",
               'value' => function() { return $this->lake_guid; },
            ]
        ]);

    }

    // TODO: Change this to more specificity, i.e. last_updated_lake rather than last_updated_source
    protected function getMappingForDates()
    {

        if ($this->excludeDates)
        {
            return $ret;
        }

        $ret = parent::getMappingForDates();

        $ret[] = [
           "name" => 'last_updated_fedora',
           'doc' => "Date and time the resource was updated in LAKE, our digital asset management system",
           "type" => "ISO 8601 date and time",
           'value' => function() { return $this->source_modified_at ? $this->source_modified_at->toIso8601String() : NULL; },

        ];

        // We need to replace the `doc` and `value of an item already in the array
        // This is tricky since we don't key by the field name
        // We should consider doing so once this logic lives in outbound transformers
        foreach ($ret as &$field) {
            if($field['name'] == 'last_updated_source') {
                $field['doc'] = "Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data";
                $field['value'] = function() { return $this->source_indexed_at ? $this->source_indexed_at->toIso8601String() : NULL; };
            }
        }

        if (!$this->citiObject)
        {
            return $ret;
        }

        $ret[] = [
           "name" => 'last_updated_citi',
           'doc' => "Date and time the resource was updated in CITI, our collections management system",
           "type" => "ISO 8601 date and time",
           'value' => function() { return $this->citi_modified_at->toIso8601String(); },
        ];

        return $ret;

    }

}
