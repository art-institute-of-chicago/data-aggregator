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

        $this->down();

        Schema::create('sites', function (Blueprint $table) {
            $table->integer('site_id')->unsigned()->unique()->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('web_url')->nullable();
            $table->timestamps();
        });

        Schema::create('artwork_site', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('site_site_id')->unsigned()->index();
            $table->foreign('site_site_id')->references('site_id')->on('sites')->onDelete('cascade');
        });

        Schema::create('exhibition_site', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('exhibition_citi_id')->unsigned()->index();
            $table->foreign('exhibition_citi_id')->references('citi_id')->on('exhibitions')->onDelete('cascade');
            $table->integer('site_site_id')->unsigned()->index();
            $table->foreign('site_site_id')->references('site_id')->on('sites')->onDelete('cascade');
        });

        Schema::create('agent_site', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->unsigned()->index();
            $table->foreign('agent_citi_id')->references('citi_id')->on('agents')->onDelete('cascade');
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
        Schema::dropIfExists('agent_site');
        Schema::dropIfExists('exhibition_site');
        Schema::dropIfExists('sites');

    }

}
