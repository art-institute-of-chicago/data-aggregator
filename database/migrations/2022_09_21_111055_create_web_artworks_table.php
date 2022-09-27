<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebArtworksTable extends Migration
{
    public function up()
    {
        Schema::create('web_artworks', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->integer('artwork_id')->index();
            $table->boolean('has_advanced_imaging')->nullable();
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable()->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('web_artworks');
    }
}
