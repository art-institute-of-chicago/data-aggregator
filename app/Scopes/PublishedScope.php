<?php

namespace App\Scopes;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class PublishedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder
            ->when(Schema::hasColumn($model->getTable(), 'published'), function ($query) {
                return $query->where('published', '=', true);
            })
            ->when(Schema::hasColumn($model->getTable(), 'is_published'), function ($query) {
                return $query->where('is_published', '=', true);
            })
            // Logic borrows from area17/twill->/src/Models/Model->scopeVisible
            ->when(Schema::hasColumn($model->getTable(), 'publish_start_date'), function ($query) {
                return $query->where(function ($query2) {
                    return $query2->where('publish_start_date', '<=', Carbon::now())
                        ->orWhereNull('publish_start_date');
                });
            })
            ->when(Schema::hasColumn($model->getTable(), 'publish_end_date'), function ($query) {
                return $query->where(function ($query2) {
                    $query2->where('publish_end_date', '>=', Carbon::now())
                        ->orWhereNull('publish_end_date');
                });
            })
            // Account of other field names
            ->when(Schema::hasColumn($model->getTable(), 'is_private'), function ($query) {
                return $query->where('is_private', '=', false);
            })
            ->when(Schema::hasColumn($model->getTable(), 'active'), function ($query) {
                return $query->where('active', '=', true);
            });
    }


    public static function forSearch()
    {
        return [
            [
                'bool' => [
                    'should' => [
                        [
                            'bool' => [
                                'should' => [
                                    [
                                        'bool' => [
                                            'must_not' => [
                                                'exists' => [
                                                    'field' => 'published',
                                                ],
                                            ],
                                        ],
                                    ],
                                    [
                                        'term' => [
                                            'published' => true,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'bool' => [
                                'should' => [
                                    [
                                        'bool' => [
                                            'must_not' => [
                                                'exists' => [
                                                    'field' => 'is_published',
                                                ],
                                            ],
                                        ],
                                    ],
                                    [
                                        'term' => [
                                            'is_published' => true,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'bool' => [
                    'should' => [
                        [
                            'bool' => [
                                'must_not' => [
                                    'exists' => [
                                        'field' => 'publish_start_date',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'range' => [
                                'publish_start_date' => [
                                    'lte' => 'now',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'bool' => [
                    'should' => [
                        [
                            'bool' => [
                                'must_not' => [
                                    'exists' => [
                                        'field' => 'publish_end_date',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'range' => [
                                'publish_end_date' => [
                                    'gte' => 'now',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
