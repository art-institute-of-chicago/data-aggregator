<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventsTable extends Migration
{

    public function up()
    {

        Schema::table('events', function (Blueprint $table) {
            // $table->increments('id');
            $table->text('title')->change();
            // $table->integer('type');
            $table->text('short_description')->change();
            // $table->text('description')->nullable();
            $table->text('hero_caption')->change();
            // $table->boolean('is_private');
            // $table->boolean('is_after_hours');
            // $table->boolean('is_ticketed');
            // $table->boolean('is_free');
            // $table->boolean('is_member_exclusive');
            // $table->boolean('hidden');
            $table->text('rsvp_link')->change();
            $table->dateTime('start_date')->change();
            $table->dateTime('end_date')->change();
            $table->dropColumn('all_dates')->change();
            $table->text('location')->change();
            $table->dropColumn('sponsors_description')->change();
            $table->dropColumn('sponsors_sub_copy')->change();
            // $table->json('content')->nullable();
            // $table->integer('layout_type');
            $table->text('buy_button_text')->change();
            // $table->text('buy_button_caption')->nullable();
            // $table->boolean('published');
            // $table->timestamps();
            // $table->softDeletes();
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
            // $table->increments('id');
            $table->string('title')->change();
            // $table->integer('type');
            $table->string('short_description')->change();
            // $table->text('description')->nullable();
            $table->string('hero_caption')->change();
            // $table->boolean('is_private');
            // $table->boolean('is_after_hours');
            // $table->boolean('is_ticketed');
            // $table->boolean('is_free');
            // $table->boolean('is_member_exclusive');
            // $table->boolean('hidden');
            $table->string('rsvp_link')->change();
            $table->string('start_date')->change();
            $table->string('end_date')->change();
            $table->json('all_dates')->nullable()->after('end_date');
            $table->string('location')->change();
            $table->text('sponsors_description')->nullable();
            $table->text('sponsors_sub_copy')->nullable();
            // $table->json('content')->nullable();
            // $table->integer('layout_type');
            $table->string('buy_button_text')->change();
            // $table->text('buy_button_caption')->nullable();
            // $table->boolean('published');
            // $table->timestamps();
            // $table->softDeletes();
        });

    }
}
