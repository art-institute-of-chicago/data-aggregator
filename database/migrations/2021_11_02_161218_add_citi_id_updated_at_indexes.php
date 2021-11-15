<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCitiIdUpdatedAtIndexes extends Migration
{
    private $tableNames = [
        'agent_place_qualifiers',
        'agent_roles',
        'agent_types',
        'agents',
        'artwork_date_qualifiers',
        'artwork_place_qualifiers',
        'artwork_types',
        'artworks',
        'catalogues',
        'exhibitions',
        'galleries',
        'places',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: Creating indexes isn't friendly with SQLite
        if (App::environment('testing')) {
            return;
        }

        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->index(['citi_id', 'updated_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropIndex(['citi_id', 'updated_at']);
            });
        }
    }
}
