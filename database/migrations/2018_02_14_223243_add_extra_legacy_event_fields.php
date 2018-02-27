<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraLegacyEventFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('legacy_events', function (Blueprint $table) {
            $table->string('button_text')->nullable()->after('short_description');
            $table->string('button_url')->nullable()->after('button_text');
            $table->string('web_url')->nullable()->after('button_url');
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
            $table->dropColumn(['button_text',
                                'button_url',
                                'web_url']);
        });

    }
}
