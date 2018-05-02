<?php

namespace App\Http\Transformers;

class CollectionsTransformer extends ApiTransformer
{

    /**
     * Whether or not CITI is the system of record for this resource.
     *
     * @TODO Move this domain knowledge to models?
     *
     * @var boolean
     */
    public $citiObject = true;

    protected function transformIdsAndTitle($item)
    {

        if ($this->excludeIdsAndTitle)
        {
            return [];
        }

        $ret = [
            'id' => $item->getAttributeValue($item->getKeyName()),
            'title' => $item->title,
        ];

        if ($this->citiObject)
        {
            $ret['lake_guid'] = $item->lake_guid;
        }

        return $ret;

    }

    protected function transformDates($item)
    {

        $dates = parent::transformDates($item);

        $dates = $this->renameFields( $dates, [

            // For models that don't have this, nothing happens
            'citi_modified_at' => 'last_updated_citi',
            'citi_created_at' => null,

            // This transformation is relative to parent class
            'last_updated_source' => 'last_updated_fedora',

            // This replaces the field removed above
            'source_indexed_at' => 'last_updated_source',

        ]);

        return $dates;

    }

}
