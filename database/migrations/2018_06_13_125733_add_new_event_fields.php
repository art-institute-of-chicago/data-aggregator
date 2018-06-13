<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewEventFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_admission_required')->default(false)->after('buy_button_caption');
            $table->integer('ticketed_event_id')->unsigned()->nullable()->after('is_admission_required');
            $table->string('survey_url')->nullable()->after('ticketed_event_id');
            $table->string('email_series')->nullable()->after('survey_url');
            $table->string('door_time')->nullable()->after('email_series');
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
            $table->dropColumn('is_admission_required');
            $table->dropColumn('ticketed_event_id');
            $table->dropColumn('survey_url');
            $table->dropColumn('email_series');
            $table->dropColumn('door_time');
        });

    }
}
