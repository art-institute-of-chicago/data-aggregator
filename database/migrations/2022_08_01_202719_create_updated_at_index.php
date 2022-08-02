<?php

use App\Library\Migrations\CreateIndexMigration;

class CreateUpdatedAtIndex extends CreateIndexMigration
{
    protected $columnName = 'updated_at';

    protected $tableNames = [
        0 => 'digital_catalogs',
        1 => 'digital_publication_sections',
        2 => 'educator_resources',
        3 => 'event_occurrences',
        4 => 'event_programs',
        5 => 'generic_pages',
        6 => 'highlights',
        7 => 'personal_access_tokens',
        8 => 'press_releases',
        9 => 'printed_catalogs',
        10 => 'static_pages',
        11 => 'ticketed_event_types',
        12 => 'wait_times',
    ];
}
