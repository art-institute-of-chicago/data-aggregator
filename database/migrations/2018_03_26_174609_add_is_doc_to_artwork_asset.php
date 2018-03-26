<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Collections\Artwork;

class AddIsDocToArtworkAsset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // This is gonna be a heavy opeartion...
        ini_set("memory_limit", "-1");

        Schema::table('artwork_asset', function (Blueprint $table) {
            $table->boolean('is_doc')->default(false)->index()->after('preferred');
        });

        // We can assume that all non-preferred assets are docs
        Artwork::all()->each( function( $artwork ) {
            $artwork->assets()->wherePivot('preferred', '=', false)->get()->each( function( $asset ) use ( $artwork ) {
                $artwork->assets()->updateExistingPivot( $asset->lake_guid, [
                    'preferred' => true,
                    'is_doc' => true,
                ]);
            });
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('artwork_asset', function (Blueprint $table) {
            $table->dropColumn('is_doc');
        });

    }
}
