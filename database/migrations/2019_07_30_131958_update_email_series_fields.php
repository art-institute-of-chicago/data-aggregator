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
        if (Schema::hasColumn('events', 'show_affiliate_message')) {
            Schema::table('events', function (Blueprint $table) {
                $table->renameColumn('show_affiliate_message', 'show_presented_by');
            });
        }

        if (Schema::hasColumn('events', 'affiliate_group_id')) {
            Schema::table('events', function (Blueprint $table) {
                $table->renameColumn('affiliate_group_id', 'event_host_id');
            });
        }

        Schema::table('event_programs', function (Blueprint $table) {
            $table->boolean('is_event_host')->nullable()->after('is_affiliate_group');
        });

        Schema::table('email_series', function (Blueprint $table) {
            $table->dropColumn([
                'show_non_member',
                'show_member',
                'show_sustaining_fellow',
                'show_affiliate_member',
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
        });

        if (Schema::hasColumn('event_email_series', 'non_member_copy')) {
            Schema::table('event_email_series', function (Blueprint $table) {
                $table->renameColumn('non_member_copy', 'nonmember_copy');
            });
        }

        if (Schema::hasColumn('event_email_series', 'affiliate_member_copy')) {
            Schema::table('event_email_series', function (Blueprint $table) {
                $table->renameColumn('affiliate_member_copy', 'affiliate_copy');
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
            $table->renameColumn('show_presented_by', 'show_affiliate_message');
            $table->renameColumn('event_host_id', 'affiliate_group_id');
        });

        Schema::table('event_programs', function (Blueprint $table) {
            $table->dropColumn('is_event_host');
        });

        Schema::table('email_series', function (Blueprint $table) {
            $table->boolean('use_short_description')->nullable()->after('title');
            $table->boolean('show_non_member')->nullable()->after('use_short_description');
            $table->boolean('show_member')->nullable()->after('show_non_member');
            $table->boolean('show_sustaining_fellow')->nullable()->after('show_member');
            $table->boolean('show_affiliate_member')->nullable()->after('show_sustaining_fellow');
            $table->text('non_member_copy')->nullable()->after('show_affiliate_member');
            $table->text('member_copy')->nullable()->after('non_member_copy');
            $table->text('sustaining_fellow_copy')->nullable()->after('member_copy');
            $table->text('affiliate_member_copy')->nullable()->after('sustaining_fellow_copy');
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
