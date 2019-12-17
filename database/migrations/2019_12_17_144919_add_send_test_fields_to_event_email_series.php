<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSendTestFieldsToEventEmailSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_email_series', function (Blueprint $table) {
            $table->boolean('send_affiliate_test')->nullable()->after('affiliate_copy');
            $table->boolean('send_member_test')->nullable()->after('send_affiliate_test');
            $table->boolean('send_sustaining_fellow_test')->nullable()->after('send_member_test');
            $table->boolean('send_nonmember_test')->nullable()->after('send_sustaining_fellow_test');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_email_series', function (Blueprint $table) {
            $table->dropColumn([
                'send_affiliate_test',
                'send_member_test',
                'send_sustaining_fellow_test',
                'send_nonmember_test',
            ]);
        });
    }
}
