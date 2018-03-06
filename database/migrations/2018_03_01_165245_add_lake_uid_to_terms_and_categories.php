<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLakeUidToTermsAndCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('terms', function (Blueprint $table) {
            $table->string('lake_uid')->nullable()->after('lake_uri');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('lake_uid')->nullable()->after('lake_uri');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('terms', function (Blueprint $table) {
            $table->dropColumn('lake_uid');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('lake_uid');
        });

    }
}
