<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAgentPlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('agent_place');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('agent_place', function(Blueprint $table) {
            $table->increments('citi_id');
            $table->integer('agent_citi_id')->unsigned()->nullable()->index();
            $table->integer('place_citi_id')->nullable()->index();
            $table->string('qualifier')->nullable();
            $table->boolean('is_preferred')->default(false)->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('source_indexed_at')->nullable();
            $table->timestamp('citi_created_at')->nullable();
            $table->timestamp('citi_modified_at')->nullable();
            $table->timestamps();
        });

    }
}
