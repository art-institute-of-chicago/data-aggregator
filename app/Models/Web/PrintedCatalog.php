<?php

namespace App\Models\Web;

/**
 * A printed catalog on the website
 */
class PrintedCatalog extends Page
{

    protected $table = 'printed_catalogs';

    protected $casts = [
        'agent_ids' => 'array',
    ];
}
