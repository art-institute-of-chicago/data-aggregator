<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmailSeriesFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('show_affiliate_message', 'show_presented_by');
            $table->renameColumn('affiliate_group_id', 'event_host_id');
        });

        Schema::table('event_programs', function (Blueprint $table) {
            $table->boolean('is_event_host')->nullable()->after('is_affiliate_group');
        });

        Schema::table('email_series', function (Blueprint $table) {
            $table->renameColumn('show_non_member', 'show_nonmember');
            $table->renameColumn('show_affiliate_member', 'show_affiliate');
            $table->dropColumn([
                'non_member_copy',
                'member_copy',
                'sustaining_fellow_copy',
                'affiliate_member_copy',
                'use_short_description',
            ]);
        });

        Schema::table('event_email_series', function (Blueprint $table) {
            $table->dropColumn([
                'send_affiliate_member',
                'send_non_member',
                'send_sustaining_fellow',
                'send_member',
            ]);
            $table->renameColumn('non_member_copy', 'nonmember_copy');
            $table->renameColumn('affiliate_member_copy', 'affiliate_copy');
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
            $table->renameColumn('show_presented_by', 'show_affiliate_message');
            $table->renameColumn('event_host_id', 'affiliate_group_id');
        });

        Schema::table('event_programs', function (Blueprint $table) {
            $table->dropColumn('is_event_host');
        });

        Schema::table('email_series', function (Blueprint $table) {
            $table->boolean('use_short_description')->nullable()->after('title');
            $table->text('non_member_copy')->nullable()->after('show_affiliate');
            $table->text('member_copy')->nullable()->after('non_member_copy');
            $table->text('sustaining_fellow_copy')->nullable()->after('member_copy');
            $table->text('affiliate_member_copy')->nullable()->after('sustaining_fellow_copy');
            $table->renameColumn('show_nonmember', 'show_non_member');
            $table->renameColumn('show_affiliate', 'show_affiliate_member');
        });

        Schema::table('event_email_series', function (Blueprint $table) {
            $table->boolean('send_non_member')->nullable()->after('email_series_id');
            $table->boolean('send_member')->nullable()->after('send_non_member');
            $table->boolean('send_sustaining_fellow')->nullable()->after('send_member');
            $table->boolean('send_affiliate_member')->nullable()->after('send_sustaining_fellow');
            $table->renameColumn('nonmember_copy', 'non_member_copy');
            $table->renameColumn('affiliate_copy', 'affiliate_member_copy');
        });
    }
}
