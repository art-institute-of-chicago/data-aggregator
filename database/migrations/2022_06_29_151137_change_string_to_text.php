<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStringToText extends Migration
{
    private $fields = [
        'agent_place_qualifiers' => [
            'title',
        ],
        'agent_roles' => [
            'title',
        ],
        'agent_types' => [
            'title',
        ],
        'agents' => [
            'title',
            'sort_title',
        ],
        'articles' => [
            'title',
        ],
        'artwork_date_qualifiers' => [
            'title',
        ],
        'artwork_place_qualifiers' => [
            'title',
        ],
        'artwork_types' => [
            'title',
        ],
        'artworks' => [
            'main_id',
            'copyright_notice',
        ],
        'catalogues' => [
            'title',
        ],
        'category_terms' => [
            'title',
        ],
        'digital_catalogs' => [
            'title',
            'web_url',
        ],
        'digital_publication_sections' => [
            'web_url',
            'author_display',
        ],
        'educator_resources' => [
            'title',
            'web_url',
        ],
        'event_programs' => [
            'title',
        ],
        'galleries' => [
            'title',
        ],
        'generic_pages' => [
            'title',
            'web_url',
        ],
        'highlights' => [
            'title',
        ],
        'interactive_features' => [
            'title',
        ],
        'issue_articles' => [
            'title',
        ],
        'issues' => [
            'title',
        ],
        'mobile_sounds' => [
            'web_url',
        ],
        'places' => [
            'title',
        ],
        'press_releases' => [
            'title',
            'web_url',
        ],
        'printed_catalogs' => [
            'title',
            'web_url',
        ],
        'publications' => [
            'site',
            'alias',
            'web_url',
        ],
        'sections' => [
            'web_url',
        ],
        'sites' => [
            'title',
            'web_url',
        ],
        'ticketed_event_types' => [
            'title',
            'category',
        ],
        'ticketed_events' => [
            'title',
            'resource_title',
        ],
        'tours' => [
            'title',
        ],
        'wait_times' => [
            'display',
        ],
        'web_artists' => [
            'title',
        ],
    ];

    public function up()
    {
        foreach ($this->fields as $tableName => $fieldNames) {
            Schema::table($tableName, function (Blueprint $table) use ($fieldNames) {
                foreach ($fieldNames as $fieldName) {
                    $table->text($fieldName)->change();
                }
            });
        }
    }

    public function down()
    {
        foreach ($this->fields as $tableName => $fieldNames) {
            Schema::table($tableName, function (Blueprint $table) use ($fieldNames) {
                foreach ($fieldNames as $fieldName) {
                    $table->string($fieldName)->change();
                }
            });
        }
    }
}
