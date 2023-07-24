<?php

use App\Library\Migrations\RenameColumnMigration;

return new class () extends RenameColumnMigration {
    protected $columns = [
        'publications' => [
            'dsc_id' => 'id',
        ],
        'sections' => [
            'dsc_id' => 'id',
            'publication_dsc_id' => 'publication_id',
        ],
    ];

    protected $indexes = [
        'sections' => [
            'sections_publication_dsc_id_index' => 'sections_publication_id_index',
        ],
    ];
};
