<?php

namespace App\Http\Search;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as RequestFacade;

class CsvResponse extends Response
{
    /**
     * Transform response for search queries.
     *
     * @return array
     */
    public function getSearchResponse()
    {
        // Strip off extraneous search fields to simplify output
        $except = ['_score', 'thumbnail'];

        return collect($this->data())->map(function ($item) use ($except) {
            return collect($item)->except($except)->map(function ($field) {
                // If the field is an array, smush it into one cell
                if (is_array($field)) {
                    return implode(",", $field);
                }
                return $field;
            })->all();
        })->toArray();
    }

    /**
     * Add data (i.e. hits, results) to response.
     *
     * @return array
     */
    protected function data()
    {
        return parent::data()['data'];
    }
}
