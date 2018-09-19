<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDeprecatedEventFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['ticketed_event_type_id',
                                'hidden']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('events', function (Blueprint $table) {
            $table->string('ticketed_event_type_id')->nullable()->after('image_url');
            $table->boolean('hidden')->after('is_member_exclusive');
        });

    }
}
