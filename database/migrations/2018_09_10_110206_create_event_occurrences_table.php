<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventOccurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_occurrences', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->integer('event_id')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('image_url')->nullable();
            $table->text('image_caption')->nullable();
            $table->boolean('is_private')->nullable();
            $table->text('location')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->text('button_text')->nullable();
            $table->text('button_url')->nullable();
            $table->text('button_caption')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_occurrences');
    }
}
