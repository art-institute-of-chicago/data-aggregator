<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefactorArtworkCatalogues extends Migration
{
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->text('catalogue_display')->nullable()->after('inscriptions');
        });

        Schema::dropIfExists('artwork_catalogue');

        Schema::dropIfExists('catalogues');
    }

    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('catalogue_display');
        });

        Schema::create('artwork_catalogue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artwork_id')->nullable()->index();
            $table->integer('catalogue_id')->nullable();
            $table->text('number')->nullable();
            $table->text('state_edition')->nullable();
            $table->boolean('is_preferred')->default(false)->index();
        });

        Schema::create('catalogues', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('title')->nullable();
            $table->timestamp('source_updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable()->index();
        });
    }
}