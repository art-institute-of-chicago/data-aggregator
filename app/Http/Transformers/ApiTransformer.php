<?php

namespace App\Http\Transformers;

use Illuminate\Support\Facades\Log;

use League\Fractal\TransformerAbstract;

class ApiTransformer extends TransformerAbstract
{

    public $excludeIdsAndTitle = false;
    public $excludeDates = false;


    /**
     * Used for only returning a subset of fields.
     * Expects a comma-separated string.
     *
     * @link https://github.com/thephpleague/fractal/issues/226
     *
     * @var string
     */
    protected $fields;

    public function __construct($fields = null)
    {
        $this->fields = $fields ? explode(',', $fields) : null;
    }

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

        return $this->filterFields( $data );

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

    protected function filterFields($data)
    {
        if (is_null($this->fields)) {
            return $data;
        }

        return array_intersect_key($data, array_flip((array) $this->fields));
    }

}
