<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsUnlistedColumns extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('is_unlisted')->default(false);
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->boolean('is_unlisted')->default(false);
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->boolean('is_unlisted')->default(false);
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->boolean('is_unlisted')->default(false);
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('is_unlisted');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('is_unlisted');
        });

        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn('is_unlisted');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->dropColumn('is_unlisted');
        });
    }
}