<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanUpDateFields extends Migration
{

    private $tablesWithSourceCreatedAt = [
        'agents' => 'agent_type_citi_id',
        // 'archival_images',
        'artworks' => 'gallery_citi_id',
        // 'assets',
        // 'digital_label_exhibitions',
        // 'digital_labels',
        // 'event_occurrences',
        'exhibitions' => 'date_aic_end',
        'galleries' => 'type',
        'places' => 'longitude',
        // 'products',
        // 'shop_categories',
        // 'ticketed_event_types',
        // 'ticketed_events',
    ];

    private $tablesWithoutSourceModifiedAt = [
        // 'agents',
        'agent_roles' => 'title',
        'agent_types' => 'title',
        // 'archival_images',
        // 'artworks',
        'artwork_date_qualifiers' => 'title',
        'artwork_place_qualifiers' => 'title',
        'artwork_types' => 'title',
        // 'assets',
        'catalogues' => 'title',
        'category_terms' => 'parent_id',
        // 'digital_label_exhibitions',
        // 'digital_labels',
        // 'event_occurrences',
        // 'exhibitions',
        // 'galleries',
        // 'hours',
        // 'places',
        // 'products',
        // 'selections',
        // 'shop_categories',
        // 'tags',
        // 'ticketed_event_types',
        // 'ticketed_events',
    ];

    private $tablesWithSourceIndexedAt = [
        'agents',
        'artworks',
        // 'assets',
        'exhibitions',
        'galleries',
        'places',
    ];

    private $tablesWithCitiCreatedAt = [
        'agents',
        'artworks',
        'exhibitions',
        'galleries',
        'places',
    ];

    private $tablesWithCitiModifiedAt = [
        'agents',
        'artworks',
        'exhibitions',
        'galleries',
        'places',
    ];

    public function up()
    {
        $this->dropColumnFromTables(array_keys($this->tablesWithSourceCreatedAt), 'source_created_at');
        $this->dropColumnFromTables($this->tablesWithSourceIndexedAt, 'source_indexed_at');
        $this->dropColumnFromTables($this->tablesWithCitiCreatedAt, 'citi_created_at');
        $this->dropColumnFromTables($this->tablesWithCitiModifiedAt, 'citi_modified_at');

        $this->addTimestampToTables($this->tablesWithoutSourceModifiedAt, 'source_modified_at');
    }

    public function down()
    {
        $this->dropColumnFromTables(array_keys($this->tablesWithoutSourceModifiedAt), 'source_modified_at');

        $this->addTimestampToTables($this->tablesWithSourceCreatedAt, 'source_created_at');
        $this->addTimestampToTables($this->tablesWithSourceIndexedAt, 'source_indexed_at', 'source_modified_at');
        $this->addTimestampToTables($this->tablesWithCitiCreatedAt, 'citi_created_at', 'source_indexed_at');
        $this->addTimestampToTables($this->tablesWithCitiModifiedAt, 'citi_modified_at', 'citi_created_at');
    }

    private function dropColumnFromTables(array $tableNames, string $columnName)
    {
        foreach ($tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName, $columnName) {
                if (Schema::hasColumn($tableName, $columnName)) {
                    $table->dropColumn($columnName);
                }
            });
        }
    }

    private function addTimestampToTables(
        array $tableNames,
        string $columnName,
        string $beforeColumnName = null
    ) {
        if (!isset($beforeColumnName)) {
            foreach ($tableNames as $tableName => $beforeColumnName) {
                $this->addTimestampToTable($tableName, $columnName, $beforeColumnName);
            }
        } else {
            foreach ($tableNames as $tableName) {
                $this->addTimestampToTable($tableName, $columnName, $beforeColumnName);
            }
        }
    }

    private function addTimestampToTable(string $tableName, string $columnName, string $beforeColumnName)
    {
        Schema::table($tableName, function (Blueprint $table) use (
            $tableName,
            $columnName,
            $beforeColumnName
        ) {
            if (!Schema::hasColumn($tableName, $columnName)) {
                $table->timestamp($columnName)->nullable()->after($beforeColumnName);
            }
        });
    }
}
