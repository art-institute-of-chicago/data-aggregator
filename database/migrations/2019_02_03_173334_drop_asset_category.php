<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAssetCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('asset_category');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('asset_category', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('asset_lake_guid')->index(); // ...was not nullable?
            $table->string('category_lake_uid')->nullable()->index();
        });
    }
}
