<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCopyrightNoticeToAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('assets', function(Blueprint $table) {

            $table->integer('copyright_notice')->nullable()->after('content');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('assets', function (Blueprint $table) {

            $table->dropColumn('copyright_notice');

        });

    }
}
