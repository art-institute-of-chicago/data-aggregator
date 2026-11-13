<?php

namespace App\Models\Changes;

use Illuminate\Database\Eloquent\Model;

/**
 * The last-known public API representation of a record whose resource has `track_changes` enabled.
 * Each run of `changes:detect` diffs a record's current output against its snapshot.
 */
class RecordSnapshot extends Model
{
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];
}
