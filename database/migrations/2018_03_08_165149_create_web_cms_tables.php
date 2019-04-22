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
            $table->string('title')->nullable();
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
            $table->string('exhibition_message')->nullable();
            $table->string('sponsors_sub_copy')->nullable();
            $table->integer('cms_exhibition_type');
            $table->boolean('published');
            $table->boolean('is_featured')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->integer('type');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('hero_caption')->nullable();
            $table->boolean('is_private')->default(false);
            $table->boolean('is_after_hours')->default(false);
            $table->boolean('is_ticketed')->default(false);
            $table->boolean('is_free')->default(false);
            $table->boolean('is_member_exclusive')->default(false);
            $table->boolean('hidden')->default(false);
            $table->text('rsvp_link')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('location')->nullable();
            $table->json('content')->nullable();
            $table->integer('layout_type');
            $table->text('buy_button_text')->nullable();
            $table->text('buy_button_caption')->nullable();
            $table->boolean('is_admission_required')->default(false);
            $table->integer('ticketed_event_id')->unsigned()->nullable();
            $table->string('survey_url')->nullable();
            $table->string('email_series')->nullable();
            $table->string('door_time')->nullable();
            $table->string('image_url')->nullable();
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
            $table->text('short_copy')->nullable();
            $table->text('copy')->nullable();
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

        $createPagesTable = function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('web_url', 512)->nullable();
            $table->string('slug')->nullable();
            $table->text('listing_description')->nullable();
            $table->text('short_description')->nullable();
            $table->boolean('published')->nullable();
            $table->datetime('publish_start_date')->nullable();
            $table->datetime('publish_end_date')->nullable();
            $table->text('copy')->nullable();
            $table->string('imgix_uuid')->nullable();
            $table->timestamps();
            $table->softDeletes();
        };

        Schema::create('generic_pages', $createPagesTable);
        Schema::create('press_releases', $createPagesTable);
        Schema::create('research_guides', $createPagesTable);
        Schema::create('educator_resources', $createPagesTable);
        Schema::create('digital_catalogs', $createPagesTable);
        Schema::create('printed_catalogs', $createPagesTable);
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

        Schema::dropIfExists('generic_pages');
        Schema::dropIfExists('press_releases');
        Schema::dropIfExists('research_guides');
        Schema::dropIfExists('educator_resources');
        Schema::dropIfExists('digital_catalogs');
        Schema::dropIfExists('printed_catalogs');

    }
}
