<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameContentToCopyOnSelections extends Migration
{

    public function up()
    {

        Schema::table('selections', function (Blueprint $table) {
            $table->renameColumn('content', 'copy');
        });

    }


    public function down()
    {

        Schema::table('selections', function (Blueprint $table) {
            $table->renameColumn('copy', 'content');
        });

    }

}
