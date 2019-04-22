<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Symfony\Component\Console\Output\ConsoleOutput;

class DropLakeUriColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Loop through all tables, and drop the lake_uri column
        $output = new ConsoleOutput();

        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        $table_prefix = DB::getTablePrefix();

        foreach( $tables as $table_name )
        {

            if (!empty($table_prefix) && !Str::startsWith($table_name, $table_prefix))
            {
                continue;
            }

            $table_name = substr($table_name, strlen($table_prefix));

            Schema::table($table_name, function (Blueprint $table) use ($table_name, $output) {

                if( Schema::hasColumn($table_name, 'lake_uri') )
                {

                    // SQLite compains about indexes!
                    if (!App::environment('testing')) {

                        $table->dropUnique(['lake_uri']);

                    }

                    $table->dropColumn('lake_uri');
                }

            });

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $output = new ConsoleOutput();

        // Gathered from console output after running `up`
        $tables = [
            'agent_types',
            'agents',
            'artwork_types',
            'artworks',
            'assets',
            'catalogues',
            'categories',
            'exhibitions',
            'galleries',
            'places',
            'terms',
        ];

        $table_prefix = DB::getTablePrefix();

        foreach( $tables as $table_name )
        {

            if (!empty($table_prefix) && !Str::startsWith($table_name, $table_prefix))
            {
                continue;
            }

            $table_name = substr($table_name, strlen($table_prefix));

            Schema::table($table_name, function (Blueprint $table) use ($table_name) {

                // Added an if for safety, but it should always be true
                if( !Schema::hasColumn($table_name, 'lake_uri') )
                {
                    $table->string('lake_uri')->unique()->nullable()->after('title');
                }

            });

            DB::table($table_name)->update([
                'lake_uri' => DB::raw(
                    "CONCAT('" . env('LAKE_URL', 'https://localhost') . "'"
                        . ", '/', SUBSTRING( `lake_guid`, 1, 2 )"
                        . ", '/', SUBSTRING( `lake_guid`, 3, 2 )"
                        . ", '/', SUBSTRING( `lake_guid`, 5, 2 )"
                        . ", '/', SUBSTRING( `lake_guid`, 6, 2 )"
                        . ", '/', `lake_guid` )"
                )
            ]);
        }

    }
}
