<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * Hours on the website
 */
class Hour extends WebModel
{

    protected $casts = [
        'published' => 'boolean',
        'opening_time' => 'date',
        'closing_time' => 'date',
        'closed' => 'boolean',
    ];

    /**
     * Hours don't have titles. Prevents Elasticsearch error.
     */
    public function getTitleAttribute($value)
    {
        return 'Not Available';
    }

}
