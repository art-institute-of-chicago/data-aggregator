<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCitiPivotModelsIdsToCitiId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('agent_exhibition', function (Blueprint $table) {
            $table->renameColumn('id', 'citi_id');
        });

        Schema::table('agent_place', function (Blueprint $table) {
            $table->renameColumn('id', 'citi_id');
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
            $table->renameColumn('citi_id', 'id');
        });

        Schema::table('agent_place', function (Blueprint $table) {
            $table->renameColumn('citi_id', 'id');
        });

    }
}
