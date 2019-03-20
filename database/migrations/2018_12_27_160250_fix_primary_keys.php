<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixPrimaryKeys extends Migration
{

    public function up()
    {
        if (App::environment('testing'))
        {
            return;
        }

        // In my environment, this removed three records
        Schema::dropIfExists('artwork_catalogue_temp');

        Schema::create('artwork_catalogue_temp', function (Blueprint $table) {
            $table->integer('citi_id')->primary();
            $table->integer('artwork_citi_id')->nullable();
            $table->integer('catalogue_citi_id')->nullable();
            $table->text('number')->nullable();
            $table->text('state_edition')->nullable();
            $table->boolean('preferred')->default(false);
        });

        DB::statement('
            INSERT INTO `artwork_catalogue_temp`
            SELECT `citi_id`,
                ANY_VALUE(`artwork_citi_id`),
                ANY_VALUE(`catalogue_citi_id`),
                ANY_VALUE(`number`),
                ANY_VALUE(`state_edition`),
                ANY_VALUE(`preferred`)
            FROM `artwork_catalogue`
            GROUP BY `citi_id`
            ORDER BY `citi_id`
        ');

        Schema::drop('artwork_catalogue');
        Schema::rename('artwork_catalogue_temp', 'artwork_catalogue');

        // There were no duplicate records in my environment
        Schema::table('library_materials', function (Blueprint $table) {
            $table->dropIndex('library_materials_id_index');
            $table->primary('id');
        });

        Schema::table('library_terms', function (Blueprint $table) {
            $table->dropIndex('library_terms_id_index');
            $table->primary('id');
        });

    }

    public function down()
    {
        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->dropPrimary('PRIMARY');
        });

        Schema::table('library_materials', function (Blueprint $table) {
            $table->dropPrimary('PRIMARY');
            $table->index('id');
        });

        Schema::table('library_terms', function (Blueprint $table) {
            $table->dropPrimary('PRIMARY');
            $table->index('id');
        });
    }

}
