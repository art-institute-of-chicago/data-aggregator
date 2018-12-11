<?php

namespace App\Http\Transformers;

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

        // TODO: Prevent attachment of e.g. `lake_guid`, so that this post-fact filtering is unnecessary?
        // Look into how `transformIdsAndTitle` are handled in descendants.
        $data = parent::transform( $data );

        return $data;

    }

    protected function transformFields($item)
    {

        return $item->transform($this->fields);

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

    /**
     * Given an Eloquent model, extract date fields specified in `$dates` or `getDates()`.
     * Converts all dates with `toIso8601String`. Extend this method in child classes to
     * manually remove dates.
     *
     * @param Illuminate\Database\Eloquent\Model  $item
     * @return array
     */
    protected function transformDates($item)
    {
        // Start building our outbound array
        $dates = [];

        // Get date fields defined in $dates or getDates() method
        $fields = $item->getDates();

        foreach( $fields as $field )
        {
            if( $item->$field )
            {
                $dates[ $field ] = $item->$field->toIso8601String();
            }
        }

        // Some manual modifications for backwards-compatibility
        // TODO: Move this to APIv1 child of this transformer
        $dates = $this->renameFields( $dates, [
            'source_modified_at' => 'last_updated_source',
            'source_created_at' => null,
            'updated_at' => 'last_updated',
            'created_at' => null,
        ]);

        return $dates;

    }

    /**
     * Helper to rename a field in an array. If `$newField` is null,
     * the old field will be deleted w/o a replacement.
     *
     * Returns a new array i/o operating on the `$haystack` directly.
     *
     * @param  array   $haystack
     * @param  string  $oldField
     * @param  string  $newField
     * @return array
     */
    protected function renameField( $haystack, $oldField, $newField )
    {

        // Using a_k_e detects null-valued fields, but ignores undefined
        if( !is_null( $newField ) && array_key_exists( $oldField, $haystack ) )
        {
            $haystack[ $newField ] = $haystack[ $oldField ];
        }

        unset( $haystack[ $oldField ] );

        return $haystack;

    }

    /**
     * Helper to rename fields in an array, en masse. See `renameField` method.
     *
     * This expects `$fields` to follow a `['oldField' => 'newField']` format.
     * If a value is null, that field will be deleted w/o replacement.
     *
     * Returns a new array i/o operating on the `$haystack` directly.
     *
     * @param  array  $haystack
     * @param  array  $fields
     * @return array
     */
    protected function renameFields( $haystack, $fields )
    {

        foreach( $fields as $oldField => $newField )
        {
            $haystack = $this->renameField( $haystack, $oldField, $newField );
        }

        return $haystack;

    }

}
