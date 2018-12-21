<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaleDatesToTicketedEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticketed_events', function (Blueprint $table) {
            $table->timestamp('on_sale_at')->nullable()->after('end_at');
            $table->timestamp('off_sale_at')->nullable()->after('on_sale_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticketed_events', function (Blueprint $table) {
            $table->dropColumn([
                'on_sale_at',
                'off_sale_at',
            ]);
        });
    }
}
