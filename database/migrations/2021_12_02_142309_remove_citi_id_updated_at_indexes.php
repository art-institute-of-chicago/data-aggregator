<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCitiIdUpdatedAtIndexes extends Migration
{
    public function up()
    {
        if (App::environment('testing')) {
            return;
        }

        // 2021_11_02_161218_add_citi_id_updated_at_indexes
        // 2021_11_02_170800_add_citi_id_updated_at_descinding_index
        // 2021_11_29_125454_add_id_updated_at_desc_index_to_more_tables
        foreach ([
            'agent_place_qualifiers',
            'agent_roles',
            'agent_types',
            'agents',
            'artwork_date_qualifiers',
            'artwork_place_qualifiers',
            'artwork_types',
            'artworks',
            'catalogues',
            'exhibitions',
            'galleries',
            'places',
        ] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropIndexIfExists(['citi_id', 'updated_at']);
                $table->dropIndexIfExists(['citi_id', 'updated_at_desc']);
            });
        }
    }
}
