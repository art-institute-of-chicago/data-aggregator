<?php

namespace App\Library\Migrations;

use Aic\Hub\Foundation\Concerns\HasAbstractProperties;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexMigration extends Migration
{
    use HasAbstractProperties;

    protected $columnName;

    protected $tableNames;

    protected $prefix;

    public function __construct()
    {
        $this->checkProperty('columnName');
        $this->checkProperty('tableNames');
    }

    public function up()
    {
        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->index([$this->columnName]);
            });
        }
    }

    public function down()
    {
        foreach ($this->tableNames as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropIndex([$this->columnName]);
            });
        }
    }
}
