<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropResearchGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('research_guides');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('research_guides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('web_url', 512)->nullable();
            $table->string('slug')->nullable();
            $table->text('listing_description')->nullable();
            $table->text('short_description')->nullable();
            $table->boolean('published')->nullable();
            $table->datetime('publish_start_date')->nullable();
            $table->datetime('publish_end_date')->nullable();
            $table->text('copy')->nullable();
            $table->string('imgix_uuid')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
