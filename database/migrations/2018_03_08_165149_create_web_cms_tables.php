<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebCmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('name');
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('name');
            $table->string('street');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->boolean('published');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->datetime('opening_time')->nullable();
            $table->datetime('closing_time')->nullable();
            $table->integer('type');
            $table->integer('day_of_week');
            $table->boolean('closed');
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('closures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('closure_copy')->nullable();
            $table->integer('type');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('web_exhibitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('header_copy');
            $table->json('content')->nullable();
            $table->string('datahub_id');
            $table->boolean('is_visible');
            $table->string('exhibition_message');
            $table->string('sponsors_sub_copy');
            $table->integer('cms_exhibition_type');
            $table->boolean('published');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('type');
            $table->string('short_description');
            $table->text('description');
            $table->string('hero_caption');
            $table->boolean('is_private');
            $table->boolean('is_after_hours');
            $table->boolean('is_ticketed');
            $table->boolean('is_free');
            $table->boolean('is_member_exclusive');
            $table->boolean('hidden');
            $table->string('rsvp_link');
            $table->string('start_date');
            $table->string('end_date');
            $table->json('all_dates')->nullable();
            $table->string('location');
            $table->text('sponsors_description');
            $table->text('sponsors_sub_copy');
            $table->json('content')->nullable();
            $table->integer('layout_type');
            $table->string('buy_button_text');
            $table->text('buy_button_caption');
            $table->boolean('published');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamp('date');
            $table->text('copy');
            $table->boolean('published');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('selections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('short_copy');
            $table->text('content');
            $table->boolean('published');
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('also_known_as');
            $table->timestamp('intro_copy');
            $table->integer('datehub_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('type');
            $table->string('home_intro');
            $table->string('exhibition_intro');
            $table->string('art_intro');
            $table->string('visit_intro');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('tags');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('hours');
        Schema::dropIfExists('closures');
        Schema::dropIfExists('web_exhibitions');
        Schema::dropIfExists('events');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('selections');
        Schema::dropIfExists('artists');
        Schema::dropIfExists('pages');

    }
}
