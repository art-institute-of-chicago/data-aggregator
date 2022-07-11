<?php

namespace App\Models\Web;

use App\Models\WebModel;

/**
 * A digital catalog on the website
 */
class DigitalPublicationSection extends WebModel
{
    protected $casts = [
        'is_published' => 'boolean',
        'date' => 'date',
    ];
}
