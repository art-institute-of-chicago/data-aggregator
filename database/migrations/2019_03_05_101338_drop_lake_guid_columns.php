<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLakeGuidColumns extends Migration
{

    private $tables = [
        'agent_roles',
        'agent_types',
        'agents',
        'artwork_date_qualifiers',
        'artwork_dates',
        'artwork_place_qualifiers',
        'artwork_types',
        'artworks',
        'catalogues',
        'category_terms',
        'exhibitions',
        'galleries',
        'places',
    ];

    public function up()
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'lake_guid')) {
                    $table->dropColumn('lake_guid');
                }
            });
        }
    }


    public function down()
    {
        $this->up();

        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'citi_id')) {
                    $table->uuid('lake_guid')->unique()->nullable()->index()->after('citi_id');
                } elseif (Schema::hasColumn($tableName, 'lake_uid')) {
                    $table->uuid('lake_guid')->unique()->nullable()->index()->after('lake_uid');
                }
            });
        }
    }
}
