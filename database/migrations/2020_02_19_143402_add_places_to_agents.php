<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlacesToAgents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_place', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->signed()->index();
            $table->integer('place_citi_id')->signed()->index();
            $table->integer('agent_place_qualifier_citi_id')->nullable()->signed()->index();
            $table->boolean('is_preferred')->index();
        });

        Schema::create('agent_place_qualifiers', function (Blueprint $table) {
            $table->integer('citi_id')->signed()->primary();
            $table->string('title')->nullable();
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
        Schema::dropIfExists('agent_place');
        Schema::dropIfExists('agent_place_qualifiers');
    }
}
