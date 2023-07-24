<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::table('web_artists', function (Blueprint $table) {
            $table->dropColumn('title');
        });

        Schema::table('web_artists', function (Blueprint $table) {
            $table->renameColumn('datahub_id', 'agent_id');
            $table->index('agent_id');
        });

        Schema::table('web_artists', function (Blueprint $table) {
            $table->integer('agent_id')->after('id')->change();
        });
    }

    public function down()
    {
        Schema::table('web_artists', function (Blueprint $table) {
            // API-337: Not nullable as an oversight!
            $table->text('title')->after('id');
        });

        Schema::table('web_artists', function (Blueprint $table) {
            $table->integer('agent_id')->after('intro_copy')->change();
        });

        Schema::table('web_artists', function (Blueprint $table) {
            $table->dropIndex(['agent_id']);
            $table->renameColumn('agent_id', 'datahub_id');
        });
    }
};
