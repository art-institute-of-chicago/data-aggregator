<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTermTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('term_types');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // php artisan migrate:generate term_types
        Schema::create('term_types', function(Blueprint $table)
        {
            $table->integer('citi_id')->primary();
            $table->char('lake_guid', 36)->nullable()->unique();
            $table->string('title', 191)->nullable();
            $table->string('lake_uid', 191)->nullable();
            $table->timestamp('source_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('source_modified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('source_indexed_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('citi_created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('citi_modified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

    }
}
