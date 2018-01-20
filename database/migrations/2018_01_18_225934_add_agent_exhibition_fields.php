<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgentExhibitionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('agent_exhibition', function (Blueprint $table) {
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->boolean('is_host')->nullable();
            $table->boolean('is_organizer')->nullable();
            $table->integer('agent_citi_id')->unsigned()->nullable()->change();
            $table->integer('exhibition_citi_id')->unsigned()->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('agent_exhibition', function (Blueprint $table) {
            $table->removeColumn('date_start');
            $table->removeColumn('date_end');
            $table->removeColumn('is_host');
            $table->removeColumn('is_organizer');
            $table->integer('agent_citi_id')->unsigned()->nullable(false)->change();
            $table->integer('exhibition_citi_id')->unsigned()->nullable(false)->change();
        });

    }

}
