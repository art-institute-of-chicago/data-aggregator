<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultPreferredToFalse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('artwork_term', function (Blueprint $table) {
            $table->boolean('preferred')->nullable()->default(false)->change();
        });

        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->boolean('preferred')->nullable()->default(false)->change();
        });

        Schema::table('agent_place', function(Blueprint $table) {
            $table->boolean('is_preferred')->nullable()->default(false)->change();
        });

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->boolean('preferred')->nullable()->default(false)->change();
        });

        Schema::table('artwork_asset', function(Blueprint $table) {
            $table->boolean('preferred')->nullable()->default(false)->change();
        });

        \App\Models\Collections\ArtworkTerm::where('preferred', null)
            ->update(['preferred' => 0]);

        \App\Models\Collections\ArtworkCatalogue::where('preferred', null)
            ->update(['preferred' => 0]);

        \App\Models\Collections\AgentPlace::where('is_preferred', null)
            ->update(['is_preferred' => 0]);

        \App\Models\Collections\ArtworkDate::where('preferred', null)
            ->update(['preferred' => 0]);

        \DB::table('artwork_asset')
            ->where('preferred', null)
            ->update(['preferred' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('artwork_term', function (Blueprint $table) {
            $table->boolean('preferred')->nullable()->default(null)->change();
        });

        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->boolean('preferred')->nullable()->default(null)->change();
        });

        Schema::table('agent_place', function(Blueprint $table) {
            $table->boolean('is_preferred')->nullable()->default(null)->change();
        });

        Schema::create('artwork_dates', function(Blueprint $table) {
            $table->boolean('preferred')->nullable()->default(null)->change();
        });

        Schema::table('artwork_asset', function(Blueprint $table) {
            $table->boolean('preferred')->nullable()->default(null)->change();
        });

    }
}
