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
            $table = $this->_addId($table);
            $table->string('title');
            $table->integer('parent_category_shop_id')->unsigned()->nullable()->index();
            $table = $this->_addDates($table);
        });

        Schema::create('products', function (Blueprint $table) {
            $table = $this->_addId($table);
            $table->string('title')->nullable();
            $table->string('title_sort')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('sku')->nullable();
            $table->integer('external_sku')->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->integer('priority')->nullable();
            $table->float('price')->nullable();
            $table->boolean('aic_collection')->nullable();
            $table->integer('gift_box')->nullable();
            $table->boolean('holiday')->nullable();
            $table->boolean('architecture')->nullable();
            $table->boolean('glass')->nullable();
            $table->boolean('active')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artist_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->index();
            $table->integer('product_shop_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('shop_categories');
        Schema::dropIfExists('artist_product');
    }

    private function _addId($table)
    {
        $table->integer('shop_id')->unsigned()->primary();
        return $table;
    }

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('source_created_at')->nullable();
        $table->timestamp('source_modified_at')->nullable();
        $table->timestamps();
        return $table;
    }
}
