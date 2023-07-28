<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: Creating indexes isn't friendly with SQLite
        if (App::environment('testing')) {
            return;
        }

        Schema::table('assets', function (Blueprint $table) {
            $table->index('netx_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (App::environment('testing')) {
            return;
        }

        Schema::table('assets', function (Blueprint $table) {
            $table->dropIndex(['netx_uuid']);
        });
    }
};
