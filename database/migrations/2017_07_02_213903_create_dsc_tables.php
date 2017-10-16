<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDscTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('publications', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('link');
            $table = $this->_addDates($table);
        });

        Schema::create('title_pages', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('content');
            $table->integer('publication_dsc_id')->unsigned()->index();
            $table->foreign('publication_dsc_id')->references('dsc_id')->on('publications')->onDelete('cascade');
            $table = $this->_addDates($table);
        });

        Schema::create('sections', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('content');
            $table->integer('publication_dsc_id')->unsigned()->index();
            $table->foreign('publication_dsc_id')->references('dsc_id')->on('publications')->onDelete('cascade');
            $table->integer('weight');
            $table->integer('depth');
            $table = $this->_addDates($table);
        });

        Schema::create('works_of_art', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('content');
            $table->integer('publication_dsc_id')->unsigned()->index();
            $table->foreign('publication_dsc_id')->references('dsc_id')->on('publications')->onDelete('cascade');
            $table->integer('artwork_citi_id')->unsigned()->index();
            $table->foreign('artwork_citi_id')->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->integer('weight');
            $table->integer('depth');
            $table = $this->_addDates($table);
        });

        Schema::create('figures', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, 'string');
            $table->text('content');
            $table->integer('section_dsc_id')->unsigned()->index();
            $table->foreign('section_dsc_id')->references('dsc_id')->on('sections')->onDelete('cascade');
            $table = $this->_addDates($table);
        });

        Schema::create('figure_images', function(Blueprint $table) {
            $table->increments('id');
            $table->string('figure_dsc_id')->index();
            $table->foreign('figure_dsc_id')->references('dsc_id')->on('figures')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });

        Schema::create('figure_vectors', function(Blueprint $table) {
            $table->increments('id');
            $table->string('figure_dsc_id')->index();
            $table->foreign('figure_dsc_id')->references('dsc_id')->on('figures')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });

        Schema::create('collectors', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->text('content');
            $table->integer('publication_dsc_id')->unsigned()->index();
            $table->foreign('publication_dsc_id')->references('dsc_id')->on('publications')->onDelete('cascade');
            $table->integer('weight');
            $table->integer('depth');
            $table = $this->_addDates($table);
        });

    }

    private function _addIdsAndTitle($table, $idType = 'integer')
    {

        if ($idType == 'integer')
        {
            $table->$idType('dsc_id')->unsigned()->unique()->primary();
        }
        else
        {
            $table->$idType('dsc_id')->unique()->primary();
        }
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

        Schema::dropIfExists('collectors');
        Schema::dropIfExists('figure_images');
        Schema::dropIfExists('figure_vectors');
        Schema::dropIfExists('figures');
        Schema::dropIfExists('works_of_art');
        Schema::dropIfExists('title_pages');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('publications');

    }
}
