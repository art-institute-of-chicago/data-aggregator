<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticArchiveTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sites', function (Blueprint $table) {
            $table->integer('site_id')->unsigned()->unique()->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->integer('exhibition_citi_id')->unsigned()->index();
            $table->foreign('exhibition_citi_id')->references('citi_id')->on('exhibitions')->onDelete('cascade');
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('artwork_site', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('site_site_id')->unsigned()->index();
            $table->foreign('site_site_id')->references('site_id')->on('sites')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('artwork_site');
        Schema::dropIfExists('sites');

    }
}
