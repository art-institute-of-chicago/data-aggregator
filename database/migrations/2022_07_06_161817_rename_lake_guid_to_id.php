<?php

use App\Library\Migrations\RenameColumnMigration;

return new class extends RenameColumnMigration
{
    protected $columns = [
        'artwork_asset' => [
            'asset_lake_guid' => 'asset_id',
        ],
        'assets' => [
            'lake_guid' => 'id',
        ],
        'exhibition_asset' => [
            'asset_lake_guid' => 'asset_id',
        ],
    ];

    protected $indexes = [
        'artwork_asset' => [
            'artwork_asset_asset_lake_guid_index' => 'artwork_asset_asset_id_index',
        ],
        'exhibition_asset' => [
            'exhibition_asset_asset_lake_guid_index' => 'exhibition_asset_asset_id_index',
        ],
    ];
};
