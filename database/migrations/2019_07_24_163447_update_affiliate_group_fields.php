<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAffiliateGroupFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('affiliate_group_display');
            $table->renameColumn('is_presented_by_affiliate', 'show_affiliate_message');
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
            $table->renameColumn('show_affiliate_message', 'is_presented_by_affiliate');
            $table->text('affiliate_group_display')->nullable()->after('is_presented_by_affiliate');
        });
    }
}
