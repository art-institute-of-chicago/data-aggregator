<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLegacyTicketUrlText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('legacy_events', function (Blueprint $table) {
            $table->text('button_url')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('legacy_events', function (Blueprint $table) {
            $table->string('button_url')->nullable()->change();
        });

    }
}
