<?php

use App\Library\Migrations\RenameColumnMigration;

class RenamePlaceIdToGalleryIdOnExhibitions extends RenameColumnMigration
{
    protected $columns = [
        'exhibitions' => [
            'place_id' => 'gallery_id',
        ],
    ];

    protected $indexes = [
        'exhibitions' => [
            'exhibitions_place_id_index' => 'exhibitions_gallery_id_index',
        ],
    ];
}
