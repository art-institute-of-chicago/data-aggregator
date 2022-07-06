<?php

namespace App\Library\Migrations;

use Aic\Hub\Foundation\Concerns\HasAbstractProperties;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnMigration extends Migration
{
    use HasAbstractProperties;

    protected $columns;

    public function __construct()
    {
        $this->checkProperty('columns');
    }

    public function up()
    {
        foreach ($this->columns as $tableName => $columns) {
            Schema::table($tableName, function (Blueprint $table) use ($columns) {
                foreach ($columns as $oldColumn => $newColumn) {
                    $table->renameColumn($oldColumn, $newColumn);
                }
            });
        }

        foreach ($this->indexes as $tableName => $indexes) {
            Schema::table($tableName, function (Blueprint $table) use ($indexes) {
                foreach ($indexes as $oldIndex => $newIndex) {
                    $table->renameIndex($oldIndex, $newIndex);
                }
            });
        }
    }

    public function down()
    {
        foreach ($this->columns as $tableName => $columns) {
            Schema::table($tableName, function (Blueprint $table) use ($columns) {
                foreach ($columns as $oldColumn => $newColumn) {
                    $table->renameColumn($newColumn, $oldColumn);
                }
            });
        }

        foreach ($this->indexes as $tableName => $indexes) {
            Schema::table($tableName, function (Blueprint $table) use ($indexes) {
                foreach ($indexes as $oldIndex => $newIndex) {
                    $table->renameIndex($newIndex, $oldIndex);
                }
            });
        }
    }
}
