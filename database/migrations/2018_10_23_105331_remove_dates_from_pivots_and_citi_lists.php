<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDatesFromPivotsAndCitiLists extends Migration
{

    private $tablesWithSourceFields = [
        'agent_roles',
        'agent_types',
        'artwork_catalogue', // pivot
        'artwork_date_qualifiers',
        'artwork_place_qualifiers',
        'artwork_term', // pivot
        'artwork_types',
        'catalogues',
        'category_terms',
    ];

    private $tablesWithTimestamps = [
        'artwork_artwork',
        'artwork_catalogue',
        // 'artwork_dates', // fake-required by global scope, but cf. 97927
        'artwork_term',
    ];

    public function up()
    {
        // Unfortunately, CITI doesn't provide lastmod dates for these lists, and LAKE
        // just makes some up. We can't rely on them. We should track changes ourselves.
        foreach($this->tablesWithSourceFields as $table)
        {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn([
                    'source_created_at',
                    'source_modified_at',
                    'source_indexed_at',
                    'citi_created_at',
                    'citi_modified_at',
                ]);
            });
        }

        // For pivot models, there's no need to keep source mod dates.
        // We do want to keep our own mod dates for lists, though.
        foreach($this->tablesWithTimestamps as $table)
        {
            Schema::table($table, function (Blueprint $table) {
                $table->dropTimestamps();
            });
        }
    }

    public function down()
    {
        foreach($this->tablesWithSourceFields as $table)
        {
            Schema::table($table, function (Blueprint $table) {
                $table->timestamp('source_created_at')->nullable()->default(null);
                $table->timestamp('source_modified_at')->nullable()->default(null);
                $table->timestamp('source_indexed_at')->nullable()->default(null);
                $table->timestamp('citi_created_at')->nullable()->default(null);
                $table->timestamp('citi_modified_at')->nullable()->default(null);
            });
        }

        foreach($this->tablesWithTimestamps as $table)
        {
            Schema::table($table, function (Blueprint $table) {
                $table->timestamps();
            });
        }
    }
}
