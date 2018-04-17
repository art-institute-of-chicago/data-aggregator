<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtworkPlaceQualifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artwork_place_qualifiers', function (Blueprint $table) {

            $table->integer('citi_id')->signed()->primary();
            $table->uuid('lake_guid')->nullable()->unique()->index();

            $table->string('title')->nullable();

            $this->_addDates( $table );

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_place_qualifiers');
    }

    // TODO: Move these to an Abstract migration?
    // TODO: These shouldn't default to useCurrent()
    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('source_created_at')->nullable()->useCurrent();
        $table->timestamp('source_modified_at')->nullable()->useCurrent();
        $table->timestamp('source_indexed_at')->nullable()->useCurrent();

        if ($citiField)
        {

            $table->timestamp('citi_created_at')->nullable()->useCurrent();
            $table->timestamp('citi_modified_at')->nullable()->useCurrent();

        }

        $table->timestamps();
        return $table;
    }

}
