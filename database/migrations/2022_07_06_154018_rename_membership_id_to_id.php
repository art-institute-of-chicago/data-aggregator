<?php

use App\Library\Migrations\RenameColumnMigration;

return new class () extends RenameColumnMigration {
    protected $columns = [
        'ticketed_event_types' => [
            'membership_id' => 'id',
        ],
        'ticketed_events' => [
            'membership_id' => 'id',
        ],
    ];

    protected $indexes = [
        // nothing to change
    ];
};
