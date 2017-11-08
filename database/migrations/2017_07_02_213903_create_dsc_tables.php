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

        Schema::dropIfExists('sections');
        Schema::dropIfExists('publications');

        Schema::create('publications', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table);
            $table->string('site')->nullable();
            $table->string('alias')->nullable();
            $table->string('web_url')->nullable();
            $table = $this->_addDates($table);
        });

        Schema::create('sections', function (Blueprint $table) {
            $table = $this->_addIdsAndTitle($table, 'bigInteger');
            $table->string('web_url')->nullable();
            $table->string('accession')->nullable()->index();
            $table->integer('revision')->nullable();
            $table->integer('source_id')->nullable()->index();
            $table->integer('weight')->nullable()->index();
            $table->integer('publication_dsc_id')->unsigned()->index();
            $table->foreign('publication_dsc_id')->references('dsc_id')->on('publications')->onDelete('cascade');
            $table->integer('artwork_citi_id')->nullable()->unsigned()->index();
            $table->foreign('artwork_citi_id')->nullable()->references('citi_id')->on('artworks')->onDelete('cascade');
            $table->longText('content')->nullable();
            $table = $this->_addDates($table);
        });

        // Because these are self-referential, the table must be created first
        Schema::table('sections', function (Blueprint $table) {
            $table->bigInteger('parent_id')->nullable()->unsigned()->index();
            $table->foreign('parent_id')->references('dsc_id')->on('sections')->onDelete('cascade');
        });

    }

    private function _addIdsAndTitle($table, $idType = 'integer')
    {

        if ( in_array( $idType, ['integer', 'bigInteger']) )
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

        Schema::dropIfExists('sections');
        Schema::dropIfExists('publications');

    }
}
