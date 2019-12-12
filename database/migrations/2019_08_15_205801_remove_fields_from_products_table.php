<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldsFromProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'sale_price',
                'member_price',
                'recipient',
                'x_shipping_charge',
                'inventory',
                'choking_hazard',
                'back_order',
                'back_order_due_date',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->float('sale_price')->nullable();
            $table->float('member_price')->nullable();
            $table->string('recipient')->nullable();
            $table->integer('x_shipping_charge')->nullable();
            $table->integer('inventory')->nullable();
            $table->boolean('choking_hazard')->nullable();
            $table->boolean('back_order')->nullable();
            $table->date('back_order_due_date')->nullable();
        });
    }
}
