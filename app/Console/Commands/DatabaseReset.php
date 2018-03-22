<?php

namespace App\Console\Commands;

use DB;
use Schema;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class DatabaseReset extends BaseCommand
{

    protected $signature = 'db:reset';

    protected $description = 'Removes all tables in current database';

    public function handle()
    {

        if( $this->confirmReset() )
        {
            $this->dropTables();

        } else {

            $this->info('Database reset command aborted. Whew!');

        }

    }

    private function confirmReset()
    {

        return (
            $this->confirm('Are you sure you want to drop all tables in `'.env('DB_DATABASE').'`? [y|N]')
        ) && (
            env('APP_ENV') === 'local' || $this->confirm('You aren\'t running in `local` environment. Are you really sure? [y|N]')
        ) && (
            env('APP_ENV') !== 'production' || $this->confirm('You are in production! Are you really, really sure? [y|N]')
        );

    }

    private function dropTables()
    {

        // In case we get interrupted midway
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Specifying `FULL` returns `Table_type`
        $tables = DB::select("SHOW FULL TABLES;");

        foreach( $tables as $table )
        {

            $table_array = get_object_vars( $table );
            $table_name = $table_array[ key( $table_array ) ];

            switch( $table_array['Table_type'] )
            {
                case 'VIEW':
                    DB::statement('DROP VIEW `' . $table_name . '`;');
                    $this->warn( 'Dropped view ' . $table_name );
                break;
                default:
                    Schema::drop( $table_name );
                    $this->info( 'Dropped table ' . $table_name );
                break;
            }

        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

}
