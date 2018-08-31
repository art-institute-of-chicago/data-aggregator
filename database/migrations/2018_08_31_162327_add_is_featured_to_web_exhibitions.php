<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsFeaturedToWebExhibitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->boolean('is_featured')->nullable()->after('published');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('web_exhibitions', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });

    }
}
