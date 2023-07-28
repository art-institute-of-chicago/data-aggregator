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
        Schema::table('artwork_term', function (Blueprint $table) {
            $table->index(['artwork_citi_id', 'term_lake_uid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artwork_term', function (Blueprint $table) {
            $table->dropIndex(['artwork_citi_id', 'term_lake_uid']);
        });
    }
};
