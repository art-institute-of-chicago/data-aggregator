<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('test_emails');
        });

        Schema::dropIfExists('email_series');

        Schema::dropIfExists('event_email_series');
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->text('test_emails')->nullable()->after('image_url');
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
            $table->text('luminary_copy')->nullable();
            $table->text('affiliate_copy')->nullable();
            $table->boolean('send_affiliate_test')->nullable();
            $table->boolean('send_member_test')->nullable();
            $table->boolean('send_luminary_test')->nullable();
            $table->boolean('send_nonmember_test')->nullable();
        });
    }
};
