<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('products', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->integer('parent_id')->nullable()->after('title');
            $table->integer('category_id')->nullable()->after('parent_id');
            $table->integer('external_sku')->nullable()->after('sku');
            $table->string('title_sort')->nullable()->after('title');
            $table->string('image_url')->nullable()->after('image');
            $table->float('sale_price')->nullable()->after('price');
            $table->float('member_price')->nullable()->after('sale_price');
            $table->boolean('aic_collection')->nullable()->after('member_price');
            $table->integer('gift_box')->nullable()->after('aic_collection');
            $table->string('recipient')->nullable()->after('gift_box');
            $table->boolean('holiday')->nullable()->after('recipient');
            $table->boolean('architecture')->nullable()->after('holiday');
            $table->boolean('glass')->nullable()->after('architecture');
            $table->integer('x_shipping_charge')->nullable()->after('glass');
            $table->integer('inventory')->nullable()->after('x_shipping_charge');
            $table->boolean('choking_hazard')->nullable()->after('inventory');
            $table->boolean('back_order')->nullable()->after('choking_hazard');
            $table->date('back_order_due_date')->nullable()->after('back_order');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('link');
            $table->dropColumn('title_display');
            $table->dropColumn('on_sale');
            $table->dropColumn('review_count');
            $table->dropColumn('items_sold');
            $table->dropColumn('rating');
        });

        Schema::create('artist_product', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->index();
            $table->integer('product_shop_id')->index();
        });

        Schema::dropIfExists('product_shop_category');
        Schema::dropIfExists('shop_categories');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('products', function (Blueprint $table) {
            $table->string('title_display')->nullable()->after('sku');
            $table->string('link')->nullable()->after('title_display');
            $table->string('image')->nullable()->after('link');
            $table->boolean('on_sale')->nullable()->after('description');
            $table->integer('review_count')->nullable()->after('price');
            $table->integer('items_sold')->nullable()->after('review_count');
            $table->float('rating')->nullable()->after('items_sold');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('category_id');
            $table->dropColumn('external_sku');
            $table->dropColumn('title_sort');
            $table->dropColumn('image_url');
            $table->dropColumn('sale_price');
            $table->dropColumn('member_price');
            $table->dropColumn('aic_collection');
            $table->dropColumn('gift_box');
            $table->dropColumn('recipient');
            $table->dropColumn('holiday');
            $table->dropColumn('architecture');
            $table->dropColumn('glass');
            $table->dropColumn('x_shipping_charge');
            $table->dropColumn('inventory');
            $table->dropColumn('choking_hazard');
            $table->dropColumn('back_order');
            $table->dropColumn('back_order_due_date');
        });

        Schema::create('shop_categories', function (Blueprint $table) {
            $table->integer('shop_id')->unsigned()->unique()->primary();
            $table->string('title');
            $table->string('link')->nullable();
            $table->integer('parent_category_shop_id')->unsigned()->index()->nullable();
            $table->string('type')->nullable();
            $table->integer('source_id')->nullable()->unsigned()->index();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('product_shop_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_shop_id')->unsigned()->index();
            $table->integer('category_shop_id')->unsigned()->index();
        });

        Schema::dropIfExists('artist_product');

    }
}
