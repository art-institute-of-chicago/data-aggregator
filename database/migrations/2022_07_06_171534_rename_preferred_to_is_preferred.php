<?php

use App\Library\Migrations\RenameColumnMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends RenameColumnMigration {
    protected $columns = [
        'artwork_artist' => [
            'preferred' => 'is_preferred',
        ],
        'artwork_asset' => [
            'preferred' => 'is_preferred',
        ],
        'artwork_catalogue' => [
            'preferred' => 'is_preferred',
        ],
        'artwork_dates' => [
            'preferred' => 'is_preferred',
        ],
        'artwork_place' => [
            'preferred' => 'is_preferred',
        ],
        'artwork_term' => [
            'preferred' => 'is_preferred',
        ],
        'exhibition_asset' => [
            'preferred' => 'is_preferred',
        ],
    ];

    protected $indexes = [
        'artwork_artist' => [
            'artwork_artist_preferred_index' => 'artwork_artist_is_preferred_index',
        ],
        'artwork_place' => [
            'artwork_place_preferred_index' => 'artwork_place_is_preferred_index',
        ],
        'artwork_term' => [
            'artwork_term_preferred_index' => 'artwork_term_is_preferred_index',
        ],
        'exhibition_asset' => [
            'exhibition_asset_preferred_index' => 'exhibition_asset_is_preferred_index',
        ],
    ];

    protected $addIndexToTables = [
        'artwork_asset',
        'artwork_catalogue',
        'artwork_dates',
    ];

    public function up(): void
    {
        parent::up();

        foreach ($this->addIndexToTables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->index(['is_preferred']);
            });
        }
    }

    public function down(): void
    {
        parent::down();

        foreach ($this->addIndexToTables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropIndex(['is_preferred']);
            });
        }
    }
};
