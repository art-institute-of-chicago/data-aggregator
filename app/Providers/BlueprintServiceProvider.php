<?php

namespace App\Providers;

use BadMethodCallException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class BlueprintServiceProvider extends ServiceProvider
{
    /**
     * @link https://laracasts.com/discuss/channels/laravel/writing-custom-blueprints-for-migration-in-my-large-project
     */
    public function boot()
    {
        Blueprint::macro('getDoctrineTable', function () {
            return Schema::getConnection()
                ->getDoctrineSchemaManager()
                ->listTableDetails($this->prefix . $this->table);
        });

        Blueprint::macro('hasIndex', function ($index, $type = 'index') {
            if (!in_array($type, ['index', 'primary', 'unique', 'spatialIndex', 'foreign'])) {
                throw new BadMethodCallException(
                    'Invalid type passed to hasIndex: ' . $type
                );
            }

            $doctrineTable = $this->getDoctrineTable();

            // If the given "index" is actually an array of columns,
            // build the index name from the columns per convention.
            if (is_array($index)) {
                $index = $this->createIndexName($type, $columns = $index);
            }

            return $doctrineTable->hasIndex($index);
        });

        Blueprint::macro('dropIndexIfExists', function ($index) {
            if ($this->hasIndex($index)) {
                return $this->dropIndex($index);
            }
        });
    }
}
