<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeTermsManyToMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('terms', function (Blueprint $table) {
            $table->increments('citi_id');
            //$table->integer('citi_id')->unique()->primary();
            $table->uuid('lake_guid')->unique()->nullable()->index();
            $table->string('title')->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->string('type')->nullable();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamp('source_indexed_at')->nullable()->useCurrent();
            $table->timestamp('citi_created_at')->nullable()->useCurrent();
            $table->timestamp('citi_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('artwork_term', function (Blueprint $table) {
            $table->integer('artwork_citi_id')->nullable();
            $table->integer('term_citi_id')->nullable();
            $table->boolean('preferred')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('source_indexed_at')->nullable();
            $table->timestamp('citi_created_at')->nullable();
            $table->timestamp('citi_modified_at')->nullable();
            $table->timestamps();
        });

        Schema::dropIfExists('artwork_terms');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('terms');
        Schema::dropIfExists('artwork_term');

        Schema::create('artwork_terms', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->string('term')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

    }
}
