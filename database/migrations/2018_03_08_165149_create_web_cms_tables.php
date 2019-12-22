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

        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content');
            $table->boolean('published');
            $table->timestamps();
        });

        Schema::create('web_exhibitions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('header_copy')->nullable();
            $table->text('list_description')->nullable();
            $table->json('content')->nullable();
            $table->text('web_url')->nullable();
            $table->text('image_url')->nullable();
            $table->integer('datahub_id')->nullable();
            $table->text('exhibition_message')->nullable();
            $table->boolean('is_published');
            $table->boolean('is_featured')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('title_display')->nullable();
            $table->integer('type')->nullable();
            $table->json('alt_event_types')->nullable();
            $table->integer('audience')->nullable();
            $table->json('alt_audiences')->nullable();
            $table->json('programs')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('hero_caption')->nullable();
            $table->text('header_description')->nullable();
            $table->text('list_description')->nullable();
            $table->text('search_tags')->nullable();
            $table->boolean('is_private')->default(false);
            $table->boolean('is_after_hours')->default(false);
            $table->boolean('is_ticketed')->default(false);
            $table->boolean('is_free')->default(false);
            $table->boolean('is_member_exclusive')->default(false);
            $table->boolean('is_sold_out')->nullable();
            $table->text('rsvp_link')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('forced_date')->nullable();
            $table->text('location')->nullable();
            $table->json('content')->nullable();
            $table->integer('layout_type');
            $table->string('slug')->nullable();
            $table->text('buy_button_text')->nullable();
            $table->text('buy_button_caption')->nullable();
            $table->boolean('is_registration_required')->nullable();
            $table->boolean('is_admission_required')->default(false);
            $table->integer('ticketed_event_id')->unsigned()->nullable();
            $table->string('survey_url')->nullable();
            $table->text('join_url')->nullable();
            $table->text('entrance')->nullable();
            $table->boolean('show_presented_by')->nullable();
            $table->integer('event_host_id')->nullable();
            $table->string('door_time')->nullable();
            $table->text('image_url')->nullable();
            $table->text('test_emails')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('sponsor_id')->nullable();
        });

        Schema::create('event_occurrences', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->integer('event_id')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->text('image_caption')->nullable();
            $table->boolean('is_private')->nullable();
            $table->text('location')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->text('button_text')->nullable();
            $table->text('button_url')->nullable();
            $table->text('button_caption')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('event_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('is_affiliate_group')->nullable();
            $table->boolean('is_event_host')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('email_series', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('title');
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('event_email_series', function (Blueprint $table) {
            $table->integer('event_id')->nullable()->index();
            $table->integer('email_series_id')->nullable()->index();
            $table->text('nonmember_copy')->nullable();
            $table->text('member_copy')->nullable();
            $table->text('sustaining_fellow_copy')->nullable();
            $table->text('affiliate_copy')->nullable();
            $table->boolean('send_affiliate_test')->nullable();
            $table->boolean('send_member_test')->nullable();
            $table->boolean('send_sustaining_fellow_test')->nullable();
            $table->boolean('send_nonmember_test')->nullable();
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
            $table->json('agent_ids')->nullable();
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
            $table->text('intro_copy')->nullable();
            $table->integer('datahub_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('static_pages', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->text('title')->nullable();
            $table->text('web_url')->nullable();
            $table->timestamps();
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
        Schema::create('educator_resources', $createPagesTable);
        Schema::create('digital_catalogs', $createPagesTable);
        Schema::create('printed_catalogs', $createPagesTable);

        Schema::table('generic_pages', function (Blueprint $table) {
            $table->text('search_tags')->nullable()->after('copy');
        });

        $addPublishDates = function (Blueprint $table) {
            $table->datetime('publish_start_date')->nullable()->after('published');
            $table->datetime('publish_end_date')->nullable()->after('publish_start_date');
        };

        Schema::table('articles', $addPublishDates);
        Schema::table('events', $addPublishDates);
        Schema::table('selections', $addPublishDates);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hours');
        Schema::dropIfExists('closures');
        Schema::dropIfExists('sponsors');
        Schema::dropIfExists('web_exhibitions');
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_occurrences');
        Schema::dropIfExists('event_programs');
        Schema::dropIfExists('email_series');
        Schema::dropIfExists('event_email_series');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('selections');
        Schema::dropIfExists('web_artists');
        Schema::dropIfExists('static_pages');

        Schema::dropIfExists('generic_pages');
        Schema::dropIfExists('press_releases');
        Schema::dropIfExists('educator_resources');
        Schema::dropIfExists('digital_catalogs');
        Schema::dropIfExists('printed_catalogs');
    }
}
