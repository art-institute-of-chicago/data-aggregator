<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixMobileTitles extends Migration
{

    private $tables = [
        'mobile_artworks',
        'mobile_sounds',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        foreach( $this->tables as $table )
        {

            Schema::table($table, function (Blueprint $table) {
                $table->text('title')->change();
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

        foreach( $this->tables as $table )
        {

            Schema::table($table, function (Blueprint $table) {
                $table->string('title')->change();
            });

        }

    }
}
