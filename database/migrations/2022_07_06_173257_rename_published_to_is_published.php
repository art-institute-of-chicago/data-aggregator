<?php

use App\Library\Migrations\RenameColumnMigration;

return new class () extends RenameColumnMigration {
    protected $columns = [
        'articles' => [
            'published' => 'is_published',
        ],
        'assets' => [
            'published' => 'is_published',
        ],
        'digital_catalogs' => [
            'published' => 'is_published',
        ],
        'digital_publication_sections' => [
            'published' => 'is_published',
        ],
        'educator_resources' => [
            'published' => 'is_published',
        ],
        'events' => [
            'published' => 'is_published',
        ],
        'experiences' => [
            'published' => 'is_published',
        ],
        'generic_pages' => [
            'published' => 'is_published',
        ],
        'highlights' => [
            'published' => 'is_published',
        ],
        'interactive_features' => [
            'published' => 'is_published',
        ],
        'issue_articles' => [
            'published' => 'is_published',
        ],
        'issues' => [
            'published' => 'is_published',
        ],
        'press_releases' => [
            'published' => 'is_published',
        ],
        'printed_catalogs' => [
            'published' => 'is_published',
        ],
    ];

    protected $indexes = [
        // nothing to change
    ];
};
