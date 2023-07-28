<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('archival_images', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('title')->nullable();
            $table->text('alternate_title')->nullable();
            $table->string('web_url')->nullable();
            $table->string('collection')->nullable();
            $table->string('archive')->nullable();
            $table->string('format')->nullable();
            $table->string('file_format')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('pixel_dimensions')->nullable();
            $table->string('color')->nullable();
            $table->text('physical_notes')->nullable();
            $table->string('date')->nullable();
            $table->string('date_object')->nullable();
            $table->string('date_view')->nullable();
            $table->text('creator')->nullable();
            $table->string('additional_creator')->nullable();
            $table->string('photographer')->nullable();
            $table->string('main_id')->nullable();
            $table->string('legacy_image_id')->nullable();
            $table->json('subject_terms')->nullable();
            $table->string('view')->nullable();
            $table->text('image_notes')->nullable();
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
    public function down(): void
    {
        Schema::dropIfExists('archival_images');
    }
};
