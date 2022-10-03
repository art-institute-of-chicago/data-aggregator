<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenericPageIdToPublications extends Migration
{
    public function up()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->integer('generic_page_id')->nullable()->after('web_url');
        });
    }

    public function down()
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn('generic_page_id');
        });
    }
}
