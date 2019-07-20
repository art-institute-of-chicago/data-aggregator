<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDigitalLabelsExhibitionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_label_exhibitions', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('exhibition_citi_id')->nullable();
            $table->string('color')->nullable();
            $table->string('background_color')->nullable();
            $table->boolean('is_published')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('digital_labels', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('digital_label_exhibition_id')->nullable();
            $table->string('type')->nullable();
            $table->text('copy_text')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_published')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('artwork_digital_label', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('digital_label_id')->unsigned()->index();
            $table->integer('artwork_citi_id')->index();
        });

        Schema::create('artist_digital_label', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('digital_label_id')->unsigned()->index();
            $table->integer('agent_citi_id')->index();
        });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digital_label_exhibitions');
        Schema::dropIfExists('digital_labels');
        Schema::dropIfExists('artwork_digital_label');
        Schema::dropIfExists('artist_digital_label');
    }

    private function _addIdsAndTitle($table)
    {
        $table->integer('id')->unsigned()->primary();
        $table->string('title');
        return $table;
    }

    private function _addDates($table, $citiField = true)
    {
        $table->timestamp('source_created_at')->nullable()->useCurrent();
        $table->timestamp('source_modified_at')->nullable()->useCurrent();
        $table->timestamps();
        return $table;
    }
}
