<?php

use App\Library\Migrations\RenameColumnMigration;

return new class () extends RenameColumnMigration {
    protected $columns = [
        'artwork_category' => [
            'category_lake_uid' => 'category_id',
        ],
        'artwork_term' => [
            'term_lake_uid' => 'term_id',
        ],
        'category_terms' => [
            'lake_uid' => 'id',
        ],
    ];

    protected $indexes = [
        'artwork_category' => [
            'artwork_category_category_lake_uid_index' => 'artwork_category_category_id_index',
        ],
        'artwork_term' => [
            'artwork_term_artwork_id_term_lake_uid_index' => 'artwork_term_artwork_id_term_id_index',
            'artwork_term_term_lake_uid_index' => 'artwork_term_term_id_index',
        ],
    ];
};
