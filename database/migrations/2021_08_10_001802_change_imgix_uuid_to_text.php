<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private $tableNames = [
        'articles',
        'generic_pages',
        'press_releases',
        'educator_resources',
        'digital_catalogs',
        'printed_catalogs',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->text('imgix_uuid')->change();
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
                $table->string('imgix_uuid')->change();
            });
        }
    }
};
