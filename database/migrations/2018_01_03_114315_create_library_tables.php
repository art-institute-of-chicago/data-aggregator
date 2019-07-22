<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibraryTables extends Migration
{

    protected $material_terms = [
        'library_material_creator',
        'library_material_subject',
    ];

    public function up()
    {
        Schema::create('library_materials', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->text('title')->nullable();
            $table->integer('date')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('library_terms', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('uri')->nullable()->index();
            $table->text('title')->nullable();
            $table->timestamps();
        });

        foreach ($this->material_terms as $material_term) {

            Schema::create($material_term, function (Blueprint $table) {
                $table->increments('id');
                $table->string('material_id')->index();
                $table->string('term_id')->index();
                $table->timestamps();
            });

        }
    }

    public function down()
    {
        foreach ($this->material_terms as $material_term) {

            Schema::dropIfExists($material_term);

        }

        Schema::dropIfExists('library_materials');
        Schema::dropIfExists('library_terms');
    }

}
