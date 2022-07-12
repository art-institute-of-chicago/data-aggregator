<?php

use App\Library\Migrations\RenameColumnMigration;

class RenameSourceModifiedAtToSourceUpdatedAt extends RenameColumnMigration
{
    protected $columns = [
        'agent_place_qualifiers' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'agent_roles' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'agent_types' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'agents' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'articles' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'artwork_date_qualifiers' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'artwork_place_qualifiers' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'artwork_types' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'artworks' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'assets' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'catalogues' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'category_terms' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'digital_catalogs' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'educator_resources' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'event_occurrences' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'event_programs' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'events' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'exhibitions' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'experiences' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'galleries' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'generic_pages' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'highlights' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'interactive_features' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'issue_articles' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'issues' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'places' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'press_releases' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'printed_catalogs' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'products' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'ticketed_event_types' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'ticketed_events' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'web_artists' => [
            'source_modified_at' => 'source_updated_at',
        ],
        'web_exhibitions' => [
            'source_modified_at' => 'source_updated_at',
        ],
    ];

    protected $indexes = [
        // nothing to change
    ];
}
