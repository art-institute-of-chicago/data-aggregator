<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeDatesNullByDefault extends Migration
{

    public function up()
    {
        if (App::environment('testing'))
        {
            return; // TODO: Move away from SQLite for testing
        }

        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        $columns = [
            'source_created_at',
            'source_modified_at',
            'source_indexed_at',
            'citi_created_at',
            'citi_modified_at',
            'updated_at',
            'created_at',
        ];

        foreach ($tables as $table_name)
        {
            Schema::table($table_name, function (Blueprint $table) use ($table_name, $columns) {

                foreach ($columns as $column)
                {
                    if (Schema::hasColumn($table_name, $column))
                    {
                        $table->timestamp($column)->default(null)->nullable()->change();
                    }
                }

            });

        }
    }

    public function down()
    {
        // Before, some used to be CURRENT_TIMESTAMP. This is a one-way migration.
    }
}
