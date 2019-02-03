<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCategoryPlace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('category_place');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('category_place', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('place_citi_id')->index(); // ...was not nullable?
            $table->string('category_lake_uid')->nullable()->index();
        });
    }
}
