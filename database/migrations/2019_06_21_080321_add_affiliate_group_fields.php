<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAffiliateGroupFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->text('affiliate_group_display')->nullable()->after('is_presented_by_affiliate');
            $table->integer('affiliate_group_id')->nullable()->after('affiliate_group_display');
        });

        Schema::table('event_programs', function (Blueprint $table) {
            $table->boolean('is_affiliate_group')->nullable()->after('title');
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
            $table->dropColumn('affiliate_group_display');
            $table->dropColumn('affiliate_group_id');
        });

        Schema::table('event_programs', function (Blueprint $table) {
            $table->dropColumn('is_affiliate_group');
        });
    }
}
