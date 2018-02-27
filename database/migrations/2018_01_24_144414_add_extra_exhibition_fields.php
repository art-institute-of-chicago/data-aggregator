<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraExhibitionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('exhibitions', function (Blueprint $table) {
            $table->text('short_description')->nullable()->after('description');
            $table->string('web_url')->nullable()->after('short_description');
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
            $table->dropColumn(['short_description',
                                'web_url']);
        });

    }

}
