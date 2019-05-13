<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameWebUrlOnMobileSounds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_sounds', function (Blueprint $table) {
            $table->renameColumn('link', 'web_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobile_sounds', function (Blueprint $table) {
            $table->renameColumn('web_url', 'link');
        });
    }
}
