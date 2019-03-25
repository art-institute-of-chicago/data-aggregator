<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Symfony\Component\Console\Output\ConsoleOutput;

class SignCitiIds extends Migration
{

    public function up()
    {

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

                if( Schema::hasColumn($table_name, 'citi_id') )
                {
                    $table->dropPrimary('citi_id');
                }

                foreach( Schema::getColumnListing($table_name) as $column )
                {
                    if( Str::endsWith($column, 'citi_id') )
                    {
                        $table->integer($column)->signed()->change();

                        if (!App::environment('testing'))
                        {

                            $output->writeln( 'Signed in ' . $table_name . ': ' . $column);

                        }
                    }
                }

                if( Schema::hasColumn($table_name, 'citi_id') )
                {
                    $table->primary('citi_id');
                }

            });

        }

    }

    public function down()
    {

        // Once we insert negative ids to the database, I think we can't change it back...
        // TODO: Remove items with negative ids, and change the columns back to unsigned?

    }

}
