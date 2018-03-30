<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgentRolesToArtworkArtist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_artist', function (Blueprint $table) {

            // Should default to id of Artist (219) - in code?
            $table->integer('agent_role_citi_id')->default(219)->unsigned()->index()->after('agent_citi_id');

            // Should default to true - in code?
            $table->boolean('preferred')->default(true)->index()->after('agent_role_citi_id');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // TODO: Search for all not-preferred artwork_artists and delete them..?

        Schema::table('artwork_artist', function (Blueprint $table) {
            // TODO: Do we need to drop the index? Doesn't seem so...
            $table->dropColumn('agent_role_citi_id');
            $table->dropColumn('preferred');
        });

    }
}
