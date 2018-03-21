<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebCmsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('articles', function (Blueprint $table) {
            $table->string('imgix_uuid')->nullable()->after('copy');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('imgix_uuid');
        });

    }
}
