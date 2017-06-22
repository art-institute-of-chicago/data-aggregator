<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('shop_categories', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('link');
            $table->integer('parent_category_shop_id')->nullable();
            $table->string('type');
            $table->integer('source_id');
            $table = $this->_addDates($table);
        });

        Schema::table('shop_categories', function($table) {
            $table->foreign('parent_category_shop_id')->references('shop_id')->on('shop_categories');
        });

    }

    private function _addIdsAndTitle($table)
    {

        $table->integer('shop_id')->unique()->primary();
        $table->string('title');
        return $table;
    }

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('api_created_at')->nullable()->useCurrent();
        $table->timestamp('api_modified_at')->nullable()->useCurrent();
        $table->timestamps();
        return $table;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('shop_categories');

    }

}
