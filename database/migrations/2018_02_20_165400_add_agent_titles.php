<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgentTitles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('agents', function (Blueprint $table) {
            $table->string('sort_title')->nullable()->after('title');
            $table->json('alt_titles')->nullable()->after('ulan_uri');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn(['sort_title',
                                'alt_titles']);
        });

    }
}
