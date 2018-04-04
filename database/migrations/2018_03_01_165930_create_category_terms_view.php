<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTermsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up( $isNew = true, $withLakeUri = true, $withTermTypeId = false )
    {

        if( !$isNew )
        {
            DB::statement('DROP VIEW IF EXISTS `category_terms`;');
        }

        $lake_uri_line = $withLakeUri ? 'lake_uri,' : '';
        $term_type_id_line = $withTermTypeId ? 'term_type_id,' : 'type,';

        \DB::connection()->getPdo()->exec("
          CREATE VIEW `category_terms` AS
            SELECT DISTINCT
               lake_uid,
               lake_guid,
               title,
               {$lake_uri_line}
               {$term_type_id_line}
               source_created_at,
               source_modified_at,
               source_indexed_at,
               citi_created_at,
               citi_modified_at,
               created_at,
               updated_at
            FROM `terms`
            UNION
            SELECT DISTINCT
               lake_uid,
               lake_guid,
               title,
               {$lake_uri_line}
               type,
               source_created_at,
               source_modified_at,
               source_indexed_at,
               citi_created_at,
               citi_modified_at,
               created_at,
               updated_at
            FROM `categories`
          ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        \DB::statement('DROP VIEW IF EXISTS category_terms');

    }
}
