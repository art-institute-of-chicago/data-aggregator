<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MatchPageAndArticleSchema extends Migration
{

    private $tables = [
        'generic_pages',
        'press_releases',
        'research_guides',
        'educator_resources',
        'digital_catalogs',
        'printed_catalogs',
    ];

    public function up()
    {

        foreach( $this->tables as $tableName )
        {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('image_url');
                $table->string('imgix_uuid')->nullable()->after('text');
                $table->renameColumn('text', 'copy');
            });
        }

    }


    public function down()
    {

        foreach( $this->tables as $tableName )
        {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('imgix_uuid');
                $table->string('image_url')->nullable()->after('copy');
                $table->renameColumn('copy', 'text');
            });
        }

    }
}
