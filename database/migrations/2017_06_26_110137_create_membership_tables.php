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
            $table->integer('type_id')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->integer('resource_id')->nullable();
            $table->string('resource_title')->nullable();
            $table->boolean('is_after_hours')->nullable();
            $table->boolean('is_private_event')->nullable();
            $table->boolean('is_admission_required')->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable(); // Description
            $table->integer('available')->nullable();
            $table->integer('total_capacity')->nullable();

            $table = $this->_addDates($table);
        });

        Schema::create('members', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('street_1')->nullable();
            $table->string('street_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('membership_level')->nullable();
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
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

        Schema::dropIfExists('events');
        Schema::dropIfExists('members');

    }
}
