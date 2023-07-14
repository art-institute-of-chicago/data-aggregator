<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('library_material_creator');
        Schema::dropIfExists('library_material_subject');
        Schema::dropIfExists('library_materials');
        Schema::dropIfExists('library_terms');
    }

    public function down()
    {
        Schema::create('library_material_creator', function (Blueprint $table) {
            $table->increments('id');
            $table->string('material_id')->index();
            $table->string('term_id')->index();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable()->index();
        });

        Schema::create('library_material_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->string('material_id')->index();
            $table->string('term_id')->index();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable()->index();
        });

        Schema::create('library_materials', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->text('title')->nullable();
            $table->integer('date')->nullable()->index();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable()->index();
        });

        Schema::create('library_terms', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('uri')->nullable()->index();
            $table->text('title')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable()->index();
        });
    }
};
