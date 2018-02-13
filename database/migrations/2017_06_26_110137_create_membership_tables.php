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
            $table->string('type')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->integer('resource_id')->nullable();
            $table->string('resource_title')->nullable();
            $table->boolean('is_after_hours')->nullable();
            $table->boolean('is_private_event')->nullable();
            $table->boolean('is_admission_required')->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->integer('available')->nullable();
            $table->integer('total_capacity')->nullable();
            $table->boolean('is_ticketed')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('event_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('event_membership_id')->unsigned()->index();
            $table->foreign('event_membership_id')->references('membership_id')->on('events')->onDelete('cascade');
            $table->integer('exhibition_citi_id')->unsigned()->index();
            $table->foreign('exhibition_citi_id')->references('citi_id')->on('exhibitions')->onDelete('cascade');
        });

    }

    private function _addIdsAndTitle($table)
    {

        $table->integer('membership_id')->unsigned()->unique()->primary();
        $table->string('title')->nullable();
        return $table;

    }

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('source_created_at')->nullable();
        $table->timestamp('source_modified_at')->nullable();
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

        Schema::dropIfExists('event_exhibition');
        Schema::dropIfExists('events');

    }

}
