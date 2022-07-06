<?php

use App\Library\Migrations\RenameColumnMigration;

class RenameQueueIdToId extends RenameColumnMigration
{
    protected $columns = [
        'wait_times' => [
            'queue_id' => 'id',
        ],
    ];

    protected $indexes = [
    ];
}
