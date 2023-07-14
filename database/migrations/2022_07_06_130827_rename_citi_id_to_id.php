<?php

use App\Library\Migrations\RenameColumnMigration;

return new class extends RenameColumnMigration
{
    protected $columns = [
        'agent_place' => [
            'agent_citi_id' => 'agent_id',
            'place_citi_id' => 'place_id',
            'agent_place_qualifier_citi_id' => 'agent_place_qualifier_id',
        ],
        'agent_place_qualifiers' => [
            'citi_id' => 'id',
        ],
        'agent_roles' => [
            'citi_id' => 'id',
        ],
        'agent_types' => [
            'citi_id' => 'id',
        ],
        'agents' => [
            'citi_id' => 'id',
            'agent_type_citi_id' => 'agent_type_id',
        ],
        'artist_product' => [
            'agent_citi_id' => 'agent_id',
        ],
        'artwork_artist' => [
            'artwork_citi_id' => 'artwork_id',
            'agent_citi_id' => 'agent_id',
            'agent_role_citi_id' => 'agent_role_id',
        ],
        'artwork_asset' => [
            'artwork_citi_id' => 'artwork_id',
        ],
        'artwork_catalogue' => [
            'artwork_citi_id' => 'artwork_id',
            'catalogue_citi_id' => 'catalogue_id',
        ],
        'artwork_category' => [
            'artwork_citi_id' => 'artwork_id',
        ],
        'artwork_date_qualifiers' => [
            'citi_id' => 'id',
        ],
        'artwork_dates' => [
            'artwork_citi_id' => 'artwork_id',
            'artwork_date_qualifier_citi_id' => 'artwork_date_qualifier_id',
        ],
        'artwork_exhibition' => [
            'artwork_citi_id' => 'artwork_id',
            'exhibition_citi_id' => 'exhibition_id',
        ],
        'artwork_place' => [
            'artwork_citi_id' => 'artwork_id',
            'place_citi_id' => 'place_id',
            'artwork_place_qualifier_citi_id' => 'artwork_place_qualifier_id',
        ],
        'artwork_place_qualifiers' => [
            'citi_id' => 'id',
        ],
        'artwork_product' => [
            'artwork_citi_id' => 'artwork_id',
        ],
        'artwork_site' => [
            'artwork_citi_id' => 'artwork_id',
        ],
        'artwork_term' => [
            'artwork_citi_id' => 'artwork_id',
        ],
        'artwork_types' => [
            'citi_id' => 'id',
        ],
        'artworks' => [
            'citi_id' => 'id',
            'artwork_type_citi_id' => 'artwork_type_id',
            'gallery_citi_id' => 'gallery_id',
            'artwork_date_qualifier_citi_id' => 'artwork_date_qualifier_id',
        ],
        'catalogues' => [
            'citi_id' => 'id',
        ],
        'exhibition_asset' => [
            'exhibition_citi_id' => 'exhibition_id',
        ],
        'exhibition_product' => [
            'exhibition_citi_id' => 'exhibition_id',
        ],
        'exhibition_site' => [
            'exhibition_citi_id' => 'exhibition_id',
        ],
        'exhibitions' => [
            'citi_id' => 'id',
            'place_citi_id' => 'place_id',
        ],
        'galleries' => [
            'citi_id' => 'id',
        ],
        'mobile_artworks' => [
            'artwork_citi_id' => 'artwork_id',
        ],
        'places' => [
            'citi_id' => 'id',
        ],
        'sections' => [
            'artwork_citi_id' => 'artwork_id',
        ],
    ];

    protected $indexes = [
        'agent_place' => [
            'agent_place_agent_citi_id_index' => 'agent_place_agent_id_index',
            'agent_place_agent_place_qualifier_citi_id_index' => 'agent_place_agent_place_qualifier_id_index',
            'agent_place_place_citi_id_index' => 'agent_place_place_id_index',
        ],
        'agents' => [
            'agents_agent_type_citi_id_index' => 'agents_agent_type_id_index',
        ],
        'artist_product' => [
            'artist_product_agent_citi_id_index' => 'artist_product_agent_id_index',
        ],
        'artwork_artist' => [
            'artwork_artist_agent_citi_id_index' => 'artwork_artist_agent_id_index',
            'artwork_artist_agent_role_citi_id_index' => 'artwork_artist_agent_role_id_index',
            'artwork_artist_artwork_citi_id_index' => 'artwork_artist_artwork_id_index',
        ],
        'artwork_asset' => [
            'artwork_asset_artwork_citi_id_index' => 'artwork_asset_artwork_id_index',
        ],
        'artwork_catalogue' => [
            'artwork_catalogue_artwork_citi_id_index' => 'artwork_catalogue_artwork_id_index',
        ],
        'artwork_category' => [
            'artwork_category_artwork_citi_id_index' => 'artwork_category_artwork_id_index',
        ],
        'artwork_dates' => [
            'artwork_dates_artwork_citi_id_index' => 'artwork_dates_artwork_id_index',
        ],
        'artwork_exhibition' => [
            'artwork_exhibition_artwork_citi_id_index' => 'artwork_exhibition_artwork_id_index',
            'artwork_exhibition_exhibition_citi_id_index' => 'artwork_exhibition_exhibition_id_index',
        ],
        'artwork_place' => [
            'artwork_place_artwork_citi_id_index' => 'artwork_place_artwork_id_index',
            'artwork_place_artwork_place_qualifier_citi_id_index' => 'artwork_place_artwork_place_qualifier_id_index',
            'artwork_place_place_citi_id_index' => 'artwork_place_place_id_index',
        ],
        'artwork_product' => [
            'artwork_product_artwork_citi_id_index' => 'artwork_product_artwork_id_index',
        ],
        'artwork_site' => [
            'artwork_site_artwork_citi_id_index' => 'artwork_site_artwork_id_index',
        ],
        'artwork_term' => [
            'artwork_term_artwork_citi_id_index' => 'artwork_term_artwork_id_index',
            'artwork_term_artwork_citi_id_term_lake_uid_index' => 'artwork_term_artwork_id_term_lake_uid_index',
        ],
        'artworks' => [
            'artworks_artwork_type_citi_id_index' => 'artworks_artwork_type_id_index',
            'artworks_gallery_citi_id_index' => 'artworks_gallery_id_index',
        ],
        'exhibition_asset' => [
            'exhibition_asset_exhibition_citi_id_index' => 'exhibition_asset_exhibition_id_index',
        ],
        'exhibition_product' => [
            'exhibition_product_exhibition_citi_id_index' => 'exhibition_product_exhibition_id_index',
        ],
        'exhibition_site' => [
            'exhibition_site_exhibition_citi_id_index' => 'exhibition_site_exhibition_id_index',
        ],
        'exhibitions' => [
            'exhibitions_place_citi_id_index' => 'exhibitions_place_id_index',
        ],
        'mobile_artworks' => [
            'mobile_artworks_artwork_citi_id_index' => 'mobile_artworks_artwork_id_index',
        ],
        'sections' => [
            'sections_artwork_citi_id_index' => 'sections_artwork_id_index',
        ],
    ];
};
