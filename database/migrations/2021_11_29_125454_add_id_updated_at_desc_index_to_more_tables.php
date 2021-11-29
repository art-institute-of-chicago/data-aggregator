<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdUpdatedAtDescIndexToMoreTables extends Migration
{
    private $tableNames = [
        'agent_place_qualifiers',
        'agent_roles',
        'agent_types',
        'agents',
        'artwork_date_qualifiers',
        'artwork_place_qualifiers',
        'artwork_types',
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
        if (App::environment('testing')) {
            return;
        }

        $default = config('database.default');

        $prefix = config("database.connections.{$default}.prefix");

        foreach ($this->tableNames as $tableName) {
            DB::statement("ALTER TABLE `{$prefix}{$tableName}` ADD INDEX `{$prefix}{$tableName}_citi_id_updated_at_desc_index` (`updated_at` DESC, `citi_id` ASC)");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (App::environment('testing')) {
            return;
        }

        $default = config('database.default');

        $prefix = config("database.connections.{$default}.prefix");

        DB::statement("ALTER TABLE `{$prefix}{$tableName}` DROP INDEX `{$prefix}{$tableName}_citi_id_updated_at_desc_index`");
    }
}
