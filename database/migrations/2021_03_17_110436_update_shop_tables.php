<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateShopTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('shop_categories');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->integer('shop_id')->unsigned()->primary();
            $table->string('title');
            $table->integer('parent_category_shop_id')->unsigned()->nullable()->index();
            $table->timestamp('source_created_at')->default(null)->nullable();
            $table->timestamp('source_modified_at')->default(null)->nullable();
            $table->timestamp('created_at')->default(null)->nullable();
            $table->timestamp('updated_at')->default(null)->nullable()->index();
        });
    }
}
