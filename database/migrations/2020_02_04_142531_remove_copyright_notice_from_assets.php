<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCopyrightNoticeFromAssets extends Migration
{
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn('copyright_notice');
        });
    }

    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->integer('copyright_notice')->nullable()->after('content');
        });
    }
}
