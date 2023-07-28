<?php

use App\Library\Migrations\RenameColumnMigration;

return new class () extends RenameColumnMigration {
    protected $columns = [
        'wait_times' => [
            'queue_id' => 'id',
        ],
    ];

    protected $indexes = [
        // nothing to change
    ];
};
