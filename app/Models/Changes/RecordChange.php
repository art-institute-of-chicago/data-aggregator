<?php

namespace App\Models\Changes;

use App\Models\BaseModel;
use App\Models\ElasticSearchable;

/**
 * One entry in the log of changes to public API fields.
 *
 * `created` and `deleted` events apply to a whole record and leave `field` null.
 * `updated` events record one field each. All fields that changed in the same
 * detection pass share a `detected_at`, so consumers can group them together.
 */
class RecordChange extends BaseModel
{
    use ElasticSearchable;

    protected static $source = 'Changes';
    protected $hasSourceDates = false;

    public const CREATED = 'created';
    public const UPDATED = 'updated';
    public const DELETED = 'deleted';

    public $timestamps = false;

    protected $casts = [
        'old_value' => 'json',
        'new_value' => 'json',
        'detected_at' => 'datetime',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];

    public function scopeForResource($query, string $resource)
    {
        return $query->where('resource', $resource);
    }

    public function scopeSince($query, $since)
    {
        return $query->where('detected_at', '>=', $since);
    }
}
