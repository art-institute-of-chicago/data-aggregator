<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('events', function (Blueprint $table) {
            $table->text('title_display')->nullable()->after('title');
            $table->text('header_description')->nullable()->after('hero_caption');
            $table->text('list_description')->nullable()->after('header_description');
            $table->json('alt_event_types')->nullable()->after('type');
            $table->integer('audience')->nullable()->after('alt_event_types');
            $table->json('alt_audiences')->nullable()->after('audience');
            $table->json('programs')->nullable()->after('alt_audiences');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->text('image_url')->change();
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
            $table->string('image_url')->change();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['title_display',
                                'header_description',
                                'list_description',
                                'alt_event_types',
                                'audience',
                                'alt_audiences',
                                'programs']);
        });

    }
}
