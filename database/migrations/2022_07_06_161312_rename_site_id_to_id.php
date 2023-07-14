<?php

use App\Library\Migrations\RenameColumnMigration;

return new class extends RenameColumnMigration
{
    protected $columns = [
        'artwork_site' => [
            'site_site_id' => 'site_id',
        ],
        'exhibition_site' => [
            'site_site_id' => 'site_id',
        ],
        'sites' => [
            'site_id' => 'id',
        ],
    ];

    protected $indexes = [
        'artwork_site' => [
            'artwork_site_site_site_id_index' => 'artwork_site_site_id_index',
        ],
        'exhibition_site' => [
            'exhibition_site_site_site_id_index' => 'exhibition_site_site_id_index',
        ],
    ];
};
