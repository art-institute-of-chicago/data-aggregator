<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixUidsInArtworkCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // TODO: SQLite doesn't have CONCAT()
        if (App::environment('testing'))
        {
            return;
        }

        DB::statement("UPDATE `artwork_category`"
            . "SET `category_lake_uid`=CONCAT('PC-', `category_lake_uid`)"
            . "WHERE `category_lake_uid` NOT LIKE 'PC-%'"
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement("UPDATE `artwork_category`"
            . " SET `category_lake_uid`=SUBSTR(`category_lake_uid`, 4)"
            . " WHERE `category_lake_uid` LIKE 'PC-%'"
        );

    }
}
