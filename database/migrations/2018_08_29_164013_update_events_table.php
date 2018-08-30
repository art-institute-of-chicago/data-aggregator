<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventsTable extends Migration
{

    public function up()
    {

        Schema::table('events', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('short_description')->change();
            $table->text('hero_caption')->change();
            $table->text('rsvp_link')->change();
            $table->dateTime('start_date')->change();
            $table->dateTime('end_date')->change();
            $table->text('location')->change();
            $table->text('buy_button_text')->change();
        });

        foreach (['all_dates', 'sponsors_description', 'sponsors_sub_copy'] as $column) {
            Schema::table('events', function (Blueprint $table) use ($column) {
                $table->dropColumn($column);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('events', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('short_description')->change();
            $table->string('hero_caption')->change();
            $table->string('rsvp_link')->change();
            $table->string('start_date')->change();
            $table->string('end_date')->change();
            $table->json('all_dates')->nullable()->after('end_date');
            $table->string('location')->change();
            $table->text('sponsors_description')->nullable()->after('location');
            $table->text('sponsors_sub_copy')->nullable()->after('sponsors_sub_copy');
            $table->string('buy_button_text')->change();
        });

    }
}
