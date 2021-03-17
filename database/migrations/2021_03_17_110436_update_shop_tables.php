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

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'title_sort',
                'parent_id',
                'category_id',
                'sku',
                'priority',
                'price',
                'aic_collection',
                'gift_box',
                'holiday',
                'architecture',
                'glass',
                'active',
            ]);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('web_url')->nullable()->after('external_sku');
        });
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

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'web_url',
            ]);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('title_sort')->nullable()->after('title');
            $table->integer('parent_id')->nullable()->after('title_sort');
            $table->integer('category_id')->nullable()->after('parent_id');
            $table->string('sku')->nullable()->after('category_id');
            $table->integer('priority')->nullable()->after('description');
            $table->float('price')->nullable()->after('priority');
            $table->boolean('aic_collection')->nullable()->after('price');
            $table->integer('gift_box')->nullable()->after('aic_collection');
            $table->boolean('holiday')->nullable()->after('gift_box');
            $table->boolean('architecture')->nullable()->after('holiday');
            $table->boolean('glass')->nullable()->after('architecture');
            $table->boolean('active')->nullable()->after('glass');
        });
    }
}
