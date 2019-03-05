<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLakeUriFromAllTables extends Migration
{

    private $tables = [
        'artwork_date_qualifiers',
        'artwork_dates',
    ];

    public function up()
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'lake_uri')) {
                    $table->dropColumn('lake_uri');
                }
            });
        }
    }


    public function down()
    {
        $this->up();

        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                // This should be a text...
                $table->string('lake_uri')->unique()->nullable()->after('title');
            });
        }
    }
}
