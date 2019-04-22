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
            $table->string('name');
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('name')->nullable();
            $table->string('street')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
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
            $table->string('header_copy')->nullable();
            $table->json('content')->nullable();
            $table->string('datahub_id')->nullable();
            $table->boolean('is_visible');
            $table->string('exhibition_message')->nullable();
            $table->string('sponsors_sub_copy')->nullable();
            $table->integer('cms_exhibition_type');
            $table->boolean('published');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('type');
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('hero_caption')->nullable();
            $table->boolean('is_private')->default(false);
            $table->boolean('is_after_hours')->default(false);
            $table->boolean('is_ticketed')->default(false);
            $table->boolean('is_free')->default(false);
            $table->boolean('is_member_exclusive')->default(false);
            $table->boolean('hidden')->default(false);
            $table->string('rsvp_link')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->json('all_dates')->nullable();
            $table->string('location')->nullable();
            $table->text('sponsors_description')->nullable();
            $table->text('sponsors_sub_copy')->nullable();
            $table->json('content')->nullable();
            $table->integer('layout_type');
            $table->string('buy_button_text')->nullable();
            $table->text('buy_button_caption')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamp('date')->nullable();
            $table->text('copy')->nullable();
            $table->string('imgix_uuid')->nullable();
            $table->boolean('published');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('selections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('short_copy')->nullable();
            $table->text('content')->nullable();
            $table->boolean('published');
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('web_artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('also_known_as')->nullable();
            $table->timestamp('intro_copy')->nullable();
            $table->integer('datahub_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('type');
            $table->string('home_intro')->nullable();
            $table->string('exhibition_intro')->nullable();
            $table->string('art_intro')->nullable();
            $table->string('visit_intro')->nullable();
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
        Schema::dropIfExists('web_artists');
        Schema::dropIfExists('pages');

    }
}
