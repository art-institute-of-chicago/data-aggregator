<?php

namespace App\Models\Web;

/**
 * A digital catalog on the website
 */
class DigitalCatalog extends Page
{

    protected $table = 'digital_catalogs';

    protected $casts = [
        'agent_ids' => 'array',
    ];
}
