<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchTagsToGenericPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->text('search_tags')->nullable()->after('copy');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generic_pages', function (Blueprint $table) {
            $table->dropColumn('search_tags');
        });
    }
}
