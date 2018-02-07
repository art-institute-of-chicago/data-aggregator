<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDeparmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('departments');

        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('department_citi_id');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropColumn('department_citi_id');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->string('department_display')->nullable()->after('place_display');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('departments', function (Blueprint $table) {
            $table->integer('citi_id')->unsigned()->unique()->primary();
            $table->uuid('lake_guid')->unique()->nullable()->index();
            $table->string('title')->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamp('source_indexed_at')->nullable()->useCurrent();
            $table->timestamp('citi_created_at')->nullable()->useCurrent();
            $table->timestamp('citi_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->integer('department_citi_id')->nullable()->index()->after('collection_status');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->integer('department_citi_id')->nullable()->index()->after('status');
        });

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropColumn('department_display');
        });

    }

}
