<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class PublishedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $columns = collect(Schema::getColumnListing($model->getTable()));
        $builder
            // Account of other field names
            ->when($columns->contains('is_private'), function ($query) {
                return $query->where('is_private', '=', false);
            })
            ->when($columns->contains('active'), function ($query) {
                return $query->where('active', '=', true);
            });
    }

    public static function forSearch()
    {
        return [];
    }
}
