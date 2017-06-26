<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('events', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->integer('type')->nullable();
            $table->timestamp('on_sale')->nullable();
            $table->timestamp('off_sale')->nullable();
            $table->integer('resource')->nullable();
            $table->integer('user_event_number')->nullable();
            $table->integer('available')->nullable();
            $table->integer('total_capacity')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('has_roster')->nullable();
            $table->integer('rs_event_seat_map_id')->nullable();
            $table->boolean('private_event')->nullable();
            $table->boolean('has_holds')->nullable();
            $table = $this->_addDates($table);
        });

    }

    private function _addIdsAndTitle($table)
    {

        $table->integer('membership_id')->unique()->primary();
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

        Schema::dropIfExists('events');

    }
}
