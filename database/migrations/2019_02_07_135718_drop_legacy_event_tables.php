<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLegacyEventTables extends Migration
{
    public function up()
    {
        Schema::dropIfExists('legacy_events');
        Schema::dropIfExists('legacy_event_exhibition');
    }

    public function down()
    {
        Schema::create('legacy_events', function (Blueprint $table) {
            $table->integer('membership_id')->unsigned()->unique()->primary();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('resource_title')->nullable();
            $table->boolean('is_admission_required')->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('button_text')->nullable();
            $table->text('button_url')->nullable();
            $table->string('web_url')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();

        });

        Schema::create('legacy_event_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('legacy_event_membership_id')->unsigned()->index();
            $table->integer('exhibition_citi_id')->unsigned()->index();
        });
    }
}
