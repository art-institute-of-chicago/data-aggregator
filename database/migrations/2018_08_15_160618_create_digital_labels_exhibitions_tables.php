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
            $table->integer('exhibition_citi_id');
            $table->string('color');
            $table->string('background_color');
            $table->boolean('published');
            $table = $this->_addDates($table);
        });

        Schema::create('digital_labels', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->integer('digital_label_exhibition_id');
            $table->string('type');
            $table->text('copy_text');
            $table->string('image_url');
            $table->boolean('published');
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

    private function _addIdsAndTitle($table)
    {
        $table->integer('id')->unsigned()->unique()->primary();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digital_labels_exhibitions');
        Schema::dropIfExists('digital_labels');
        Schema::dropIfExists('artwork_digital_label');
        Schema::dropIfExists('artist_digital_label');
    }
}
