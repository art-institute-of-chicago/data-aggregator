<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Symfony\Component\Console\Output\ConsoleOutput;

class RemoveForeignKeys extends Migration
{

    public function up()
    {

        $output = new ConsoleOutput();
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        $tables = $conn->listTableNames();

        $table_prefix = DB::getTablePrefix();

        foreach( $tables as $table_name )
        {

            if (!empty($table_prefix) && !starts_with($table_name, $table_prefix))
            {
                continue;
            }

            $foreign_keys = $conn->listTableForeignKeys( $table_name );

            $table_name = substr($table_name, strlen($table_prefix));

            Schema::table($table_name, function (Blueprint $table) use ($output, $table_name, $foreign_keys) {

                foreach( $foreign_keys as $key )
                {

                    $key_name = $key->getName();

                    if (\DB::getDriverName() != 'sqlite') {
                        $table->dropForeign( $key_name );
                    }

                    if (!App::environment('testing'))
                    {

                        $output->writeln( 'Dropped `' . $key_name . '` from table `' . $table_name . '` ');

                    }

                }

            });

        }

    }

    public function down()
    {

        // It seems that we cannot add foreign keys to existing, filled tables
        // There might be a way, but working out all the bugs currently doesn't seem worth it

    }

}
