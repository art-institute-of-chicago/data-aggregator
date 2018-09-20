<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAgentExhibitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('agent_exhibition');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('agent_exhibition', function(Blueprint $table) {
            $table->increments('citi_id');
            $table->integer('agent_citi_id')->unsigned()->nullable()->index();
            $table->integer('exhibition_citi_id')->unsigned()->nullable()->index();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->boolean('is_host')->nullable();
            $table->boolean('is_organizer')->nullable();
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('source_indexed_at')->nullable();
            $table->timestamp('citi_created_at')->nullable();
            $table->timestamp('citi_modified_at')->nullable();
            $table->timestamps();
        });
    }
}
