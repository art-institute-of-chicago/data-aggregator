<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArtworkDateQualifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('artwork_date_qualifiers', function (Blueprint $table) {
            $table->integer('citi_id')->unsigned()->unique()->primary();
            $table->uuid('lake_guid')->unique()->nullable()->index();
            $table->string('title')->nullable();
            $table->string('lake_uri')->unique()->nullable();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamp('source_indexed_at')->nullable()->useCurrent();
            $table->timestamp('citi_created_at')->nullable()->useCurrent();
            $table->timestamp('citi_modified_at')->nullable()->useCurrent();
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

        Schema::dropIfExists('artwork_date_qualifiers');

    }
}
