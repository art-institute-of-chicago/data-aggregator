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
            $table->string('site')->nullable();
            $table->string('alias')->nullable();
            $table->string('web_url')->nullable();
            $table->timestamps();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, 'bigInteger');
            $table->string('web_url')->nullable();
            $table->string('accession')->nullable()->index();
            $table->integer('revision')->nullable();
            $table->integer('source_id')->nullable()->index();
            $table->integer('weight')->nullable()->index();
            $table->integer('publication_dsc_id')->unsigned()->index();
            $table->integer('artwork_citi_id')->nullable()->index();
            $table->longText('content')->nullable();
            $table->timestamps();
        });

        // Because these are self-referential, the table must be created first
        Schema::table('sections', function (Blueprint $table) {
            $table->bigInteger('parent_id')->nullable()->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
        Schema::dropIfExists('publications');
    }

    private function _addIdsAndTitle($table, $idType = 'integer')
    {
        if (in_array($idType, ['integer', 'bigInteger']))
        {
            $table->{$idType}('dsc_id')->unsigned()->primary();
        }
        else
        {
            $table->{$idType}('dsc_id')->primary();
        }
        $table->text('title');
        return $table;
    }

}
