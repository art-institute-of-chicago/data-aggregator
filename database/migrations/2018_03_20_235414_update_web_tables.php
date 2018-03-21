<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWebTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_private')->default(false)->change();
            $table->boolean('is_after_hours')->default(false)->change();
            $table->boolean('is_ticketed')->default(false)->change();
            $table->boolean('is_free')->default(false)->change();
            $table->boolean('is_member_exclusive')->default(false)->change();
            $table->boolean('hidden')->default(false)->change();
            $table->boolean('published')->default(false)->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_private')->default(null)->change();
            $table->boolean('is_after_hours')->default(null)->change();
            $table->boolean('is_ticketed')->default(null)->change();
            $table->boolean('is_free')->default(null)->change();
            $table->boolean('is_member_exclusive')->default(null)->change();
            $table->boolean('hidden')->default(null)->change();
            $table->boolean('published')->default(null)->change();
        });

    }
}
