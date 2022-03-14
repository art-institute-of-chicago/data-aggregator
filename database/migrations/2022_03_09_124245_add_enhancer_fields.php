<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnhancerFields extends Migration
{
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn('ulan_uri');
            $table->integer('ulan_id')->signed()->nullable()->after('death_place');
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->integer('support_aat_id')->signed()->nullable()->after('medium_display');
            $table->integer('dimension_width')->signed()->nullable()->after('dimensions');
            $table->integer('dimension_height')->signed()->nullable()->after('dimension_width');
        });

        Schema::table('artwork_types', function (Blueprint $table) {
            $table->integer('aat_id')->signed()->nullable()->after('title');
        });

        Schema::table('category_terms', function (Blueprint $table) {
            $table->integer('aat_id')->signed()->nullable()->after('parent_id');
        });
    }

    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('ulan_uri')->nullable()->after('death_place');
            $table->dropColumn('ulan_id');
        });

        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn([
                'support_aat_id',
                'dimension_width',
                'dimension_height',
            ]);
        });

        Schema::table('artwork_types', function (Blueprint $table) {
            $table->dropColumn('aat_id');
        });

        Schema::table('category_terms', function (Blueprint $table) {
            $table->dropColumn('aat_id');
        });
    }
}
