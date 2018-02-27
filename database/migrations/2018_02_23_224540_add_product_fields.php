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
            $table->dropColumn(['image',
                                'link',
                                'title_display',
                                'on_sale',
                                'review_count',
                                'items_sold',
                                'rating']);
        });

        Schema::create('artist_product', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_citi_id')->index();
            $table->integer('product_shop_id')->index();
        });

        Schema::table('shop_categories', function (Blueprint $table) {
            $table->dropColumn(['link',
                                'type',
                                'source_id']);
        });

        Schema::dropIfExists('product_shop_category');

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
            $table->dropColumn(['parent_id',
                                'category_id',
                                'external_sku',
                                'title_sort',
                                'image_url',
                                'sale_price',
                                'member_price',
                                'aic_collection',
                                'gift_box',
                                'recipient',
                                'holiday',
                                'architecture',
                                'glass',
                                'x_shipping_charge',
                                'inventory',
                                'choking_hazard',
                                'back_order',
                                'back_order_due_date']);
        });

        Schema::table('shop_categories', function (Blueprint $table) {
            $table->string('link')->nullable();
            $table->string('type')->nullable();
            $table->integer('source_id')->nullable()->unsigned()->index();
        });

        Schema::create('product_shop_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_shop_id')->unsigned()->index();
            $table->integer('category_shop_id')->unsigned()->index();
        });

        Schema::dropIfExists('artist_product');

    }

}
