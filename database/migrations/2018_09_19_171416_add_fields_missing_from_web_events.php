<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsMissingFromWebEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_registration_required')->nullable()->after('buy_button_caption');
            $table->boolean('is_sold_out')->nullable()->after('is_member_exclusive');
            $table->string('start_time')->nullable()->after('end_date');
            $table->string('end_time')->nullable()->after('start_time');
            $table->string('forced_date')->nullable()->after('end_time');
            $table->string('slug')->nullable()->after('layout_type');
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
            $table->dropColumn(['is_registration_required',
                                'is_sold_out',
                                'start_time',
                                'end_time',
                                'forced_date',
                                'slug']);
        });

    }
}
