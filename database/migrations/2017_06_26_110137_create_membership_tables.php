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

        Schema::create('legacy_events', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('type')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->string('resource_title')->nullable();
            $table->boolean('is_admission_required')->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('legacy_event_exhibition', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('legacy_event_membership_id')->unsigned()->index();
            $table->integer('exhibition_citi_id')->unsigned()->index();
        });

        Schema::create('ticketed_events', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->integer('resource_id')->nullable();
            $table->string('resource_title')->nullable();
            $table->boolean('is_after_hours')->nullable();
            $table->boolean('is_private_event')->nullable();
            $table->boolean('is_admission_required')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('available')->nullable();
            $table->integer('total_capacity')->nullable();
            $table = $this->_addDates($table);
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

        Schema::dropIfExists('legacy_event_exhibition');
        Schema::dropIfExists('legacy_events');
        Schema::dropIfExists('ticketed_events');

    }

}
