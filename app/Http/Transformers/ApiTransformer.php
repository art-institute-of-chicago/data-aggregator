<?php

namespace App\Http\Transformers;

use Illuminate\Support\Facades\Log;

use Aic\Hub\Foundation\AbstractTransformer;

class ApiTransformer extends AbstractTransformer
{

    public $excludeIdsAndTitle = false;
    public $excludeDates = false;

    /**
     * Turn this item object into a generic array.
     *
     * @param  Illuminate\Database\Eloquent\Model  $item
     * @return array
     */
    public function transform($item)
    {

        $data = array_merge(
            $this->transformIdsAndTitle($item),
            $this->transformFields($item),
            $this->transformDates($item)
        );

        // Filters fields, etc.
        $data = parent::transform( $data );

        return $data;

    }

    protected function transformFields($item)
    {

        return $item->transform();

    }


    protected function transformIdsAndTitle($item)
    {

        if ($this->excludeIdsAndTitle)
        {

            return [];

        }

        return [
            'id' => $item->getAttributeValue($item->getKeyName()),
            'title' => $item->title,
        ];

    }

    protected function transformDates($item)
    {

        if ($this->excludeDates)
        {
            return [];
        }

        $dates = [];

        if ( $item->source_modified_at )
        {
            $dates['last_updated_source'] = $item->source_modified_at->toIso8601String();
        }

        if ( $item->updated_at )
        {
            $dates['last_updated'] = $item->updated_at->toIso8601String();
        }

        return $dates;

    }

}
