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
            $table->string('link')->nullable();
            $table->integer('parent_category_shop_id')->nullable();
            $table->string('type')->nullable();
            $table->integer('source_id')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::table('shop_categories', function($table) {
            $table->foreign('parent_category_shop_id')->references('shop_id')->on('shop_categories');
        });

        Schema::create('products', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('sku')->nullable();
            $table->string('title_display')->nullable();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('on_sale')->nullable();
            $table->integer('priority')->nullable();
            $table->float('price')->nullable();
            $table->integer('review_count')->nullable();
            $table->integer('items_sold')->nullable();
            $table->float('rating')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('product_shop_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_shop_id');
            $table->foreign('product_shop_id')->references('shop_id')->on('products')->onDelete('cascade');
            $table->integer('category_shop_id');
            $table->foreign('category_shop_id')->references('shop_id')->on('shop_categories')->onDelete('cascade');
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

        Schema::dropIfExists('product_shop_category');
        Schema::dropIfExists('products');
        Schema::dropIfExists('shop_categories');

    }

}
