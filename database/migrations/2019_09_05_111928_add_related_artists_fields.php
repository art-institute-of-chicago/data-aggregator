<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelatedArtistsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('exhibitions', function (Blueprint $table) {
            $table->json('agent_ids')->nullable();
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->json('agent_ids')->nullable();
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->json('agent_ids')->nullable();
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->json('agent_ids')->nullable();
        });
        */

        Schema::table('agents', function (Blueprint $table) {
            $table->json('agent_ids')->nullable();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->json('agent_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exhibitions', function (Blueprint $table) {
            $table->dropColumn('agent_ids');
        });

        Schema::table('digital_catalogs', function (Blueprint $table) {
            $table->dropColumn('agent_ids');
        });

        Schema::table('educator_resources', function (Blueprint $table) {
            $table->dropColumn('agent_ids');
        });

        Schema::table('printed_catalogs', function (Blueprint $table) {
            $table->dropColumn('agent_ids');
        });

        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('agent_ids');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('agent_ids');
        });
    }
}
