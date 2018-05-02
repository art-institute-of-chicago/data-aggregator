<?php

namespace App\Http\Transformers;

class PivotTransformer extends ApiTransformer
{

    // Pivot models don't need modified dates, ids, or titles

    public $excludeIdsAndTitle = true;

    /**
     * In some cases, pivot models may include non-meta-dates in `$dates` or `getDates()`.
     * Due to this, we should *remove* unwanted dates, rather than overriding everything.
     *
     * One such extant case is the `dates` pivot on `artworks`:
     *
     * http://data-aggregator.test/api/v1/artworks/151991?include=dates&fields=id,title
     */
    protected function transformDates($item)
    {

        $dates = parent::transformDates($item);

        return $this->renameField( $dates, 'last_updated', null );

    }

}
