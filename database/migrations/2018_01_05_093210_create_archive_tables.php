<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $this->down();

        Schema::create('archival_images', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('title')->nullable();
            $table->string('alt_title')->nullable();
            $table->string('web_url')->nullable();
            $table->string('collection_name')->nullable();
            $table->string('archive_name')->nullable();
            $table->string('format')->nullable();
            $table->string('file_format')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('pixel_dimensions')->nullable();
            $table->string('color')->nullable();
            $table->string('physical_notes')->nullable();
            $table->string('date_display')->nullable();
            $table->string('date_of_object')->nullable();
            $table->string('date_of_view')->nullable();
            $table->string('creator')->nullable();
            $table->string('additional_creator')->nullable();
            $table->string('photographer')->nullable();
            $table->string('main_id')->nullable();
            $table->string('legacy_image_id')->nullable();
            $table->json('subject_terms')->nullable();
            $table->string('view')->nullable();
            $table->string('image_notes')->nullable();
            $table->string('file_name')->nullable();
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

        Schema::dropIfExists('archival_images');

    }
}
