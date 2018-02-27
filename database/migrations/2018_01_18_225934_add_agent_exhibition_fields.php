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
            $table->timestamp('source_created_at')->nullable();
            $table->timestamp('source_modified_at')->nullable();
            $table->timestamp('source_indexed_at')->nullable();
            $table->timestamp('citi_created_at')->nullable();
            $table->timestamp('citi_modified_at')->nullable();
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

        Schema::table('agent_exhibition', function (Blueprint $table) {
            $table->dropColumn(['date_start',
                                'date_end',
                                'is_host',
                                'is_organizer',
                                'source_created_at',
                                'source_modified_at',
                                'source_indexed_at',
                                'citi_created_at',
                                'citi_modified_at']);

            $table->dropTimestamps();

            App\Models\Collections\AgentExhibition::where('agent_citi_id', null)->delete();
            $table->integer('agent_citi_id')->unsigned()->nullable(false)->change();

            App\Models\Collections\AgentExhibition::where('exhibition_citi_id', null)->delete();
            $table->integer('exhibition_citi_id')->unsigned()->nullable(false)->change();
        });

    }

}
