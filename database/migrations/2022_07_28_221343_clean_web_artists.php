<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CleanWebArtists extends Migration
{
    public function up()
    {
        Schema::table('web_artists', function (Blueprint $table) {
            $table->renameColumn('datahub_id', 'agent_id');
            $table->index('agent_id');
        });
    }

    public function down()
    {
        Schema::table('web_artists', function (Blueprint $table) {
            $table->dropIndex(['agent_id']);
            $table->renameColumn('agent_id', 'datahub_id');
        });
    }
}
