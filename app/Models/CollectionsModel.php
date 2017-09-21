<?php

namespace App\Models;

use App\Models\BaseModel;

class CollectionsModel extends BaseModel
{

    protected static $source = 'Collections';

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

}
