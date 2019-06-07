<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventEmailSeriesFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('email_series');
            $table->text('join_url')->nullable()->after('survey_url');
            $table->text('entrance')->nullable()->after('join_url');
            $table->boolean('is_presented_by_affiliate')->nullable()->after('entrance');
        });

        Schema::create('email_series', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('title');
            $table->boolean('use_short_description')->nullable();
            $table->boolean('show_non_member')->nullable();
            $table->boolean('show_member')->nullable();
            $table->boolean('show_sustaining_fellow')->nullable();
            $table->boolean('show_affiliate_member')->nullable();
            $table->text('non_member_copy')->nullable();
            $table->text('member_copy')->nullable();
            $table->text('sustaining_fellow_copy')->nullable();
            $table->text('affiliate_member_copy')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('event_email_series', function (Blueprint $table) {
            $table->integer('event_id')->nullable()->index();
            $table->integer('email_series_id')->nullable()->index();
            $table->boolean('send_non_member')->nullable();
            $table->boolean('send_member')->nullable();
            $table->boolean('send_sustaining_fellow')->nullable();
            $table->boolean('send_affiliate_member')->nullable();
            $table->text('non_member_copy')->nullable();
            $table->text('member_copy')->nullable();
            $table->text('sustaining_fellow_copy')->nullable();
            $table->text('affiliate_member_copy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_series');
        Schema::dropIfExists('event_email_series');

        Schema::table('events', function (Blueprint $table) {
            $table->string('email_series')->nullable()->after('survey_url');
            $table->text('survey_url')->nullable()->change();
            $table->dropColumn('join_url');
            $table->dropColumn('entrance');
            $table->dropColumn('is_presented_by_affiliate');
        });
    }
}
