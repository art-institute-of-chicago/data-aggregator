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
            $table->boolean('preferred')->default(false)->change();
        });

        Schema::table('artwork_catalogue', function (Blueprint $table) {
            $table->boolean('preferred')->default(false)->change();
        });

        Schema::table('agent_place', function(Blueprint $table) {
            $table->boolean('is_preferred')->default(false)->change();
        });

        Schema::table('artwork_dates', function(Blueprint $table) {
            $table->boolean('preferred')->default(false)->change();
        });

        Schema::table('artwork_asset', function(Blueprint $table) {
            $table->boolean('preferred')->default(false)->change();
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

        $tables = [
            'artwork_term' => 'preferred',
            'artwork_catalogue' => 'preferred',
            'agent_place' => 'is_preferred',
            'artwork_dates' => 'preferred',
            'artwork_asset' => 'preferred',
        ];

        foreach( $tables as $table => $column )
        {
            $this->dropDefault( $table, $column );
        }

    }

    private function dropDefault( $table, $column )
    {

        \DB::statement('ALTER TABLE `' . $table . '` ALTER COLUMN `' . $column . '` DROP DEFAULT');

    }
}
