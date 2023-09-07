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
        Schema::create('digital_publication_sections', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->text('title')->nullable();
            $table->string('web_url', 512)->nullable();
            $table->string('slug')->nullable();
            $table->text('listing_description')->nullable();
            $table->boolean('published')->nullable();
            $table->datetime('publish_start_date')->nullable();
            $table->text('copy')->nullable();
            $table->string('type')->nullable();
            $table->text('heading')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('author_display')->nullable();
            $table->integer('digital_publication_id')->nullable();
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
        Schema::dropIfExists('digital_publication_sections');
    }
};
