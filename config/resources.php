<?php

return [

    'sources' => [

        'default' => env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost'),

        'Archive' => env('ARCHIVES_DATA_SERVICE_URL', 'http://localhost'),
        'Collections' => env('COLLECTIONS_DATA_SERVICE_URL', 'http://localhost'),
        'Dsc' => env('DSC_DATA_SERVICE_URL', 'http://localhost'),
        'Library' => env('LIBRARY_DATA_SERVICE_URL', 'http://localhost'),
        'Membership' => env('EVENTS_DATA_SERVICE_URL', 'http://localhost'),
        'Mobile' => env('MOBILE_DATA_SERVICE_URL', 'http://localhost'),
        'Shop' => env('SHOP_DATA_SERVICE_URL', 'http://localhost'),
        'Web' => env('WEB_CMS_DATA_SERVICE_URL', 'http://localhost'),

    ],

    // 'inbound' => [
    //     [
    //         'source' => 'Collections',
    //         'model' => \App\Models\Collections\Agent::class,
    //         'transformer' => \App\Transformers\Inbound\Agent::class,
    //     ],
    //     [
    //         'source' => 'Collections',
    //         'model' => \App\Models\Collections\AgentExhibition::class,
    //         'transformer' => \App\Transformers\Inbound\AgentExhibition::class,
    //     ],
    // ],

    'outbound' => [

        'base' => [
            [
                'endpoint' => 'artworks',
                'model' => \App\Models\Collections\Artwork::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'agents',
                'model' => \App\Models\Collections\Agent::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'artists',
                'model' => \App\Models\Collections\Agent::class,
                'scope_of' => 'agents',
            ],
            [
                'endpoint' => 'venues',
                'model' => \App\Models\Collections\Agent::class,
                'scope_of' => 'agents',
            ],
            [
                'endpoint' => 'agent-places',
                'model' => \App\Models\Collections\AgentPlace::class,
            ],
            [
                'endpoint' => 'agent-types',
                'model' => \App\Models\Collections\AgentType::class,
            ],
            [
                'endpoint' => 'agent-roles',
                'model' => \App\Models\Collections\AgentRole::class,
            ],
            [
                'endpoint' => 'artwork-types',
                'model' => \App\Models\Collections\ArtworkType::class,
            ],
            [
                'endpoint' => 'artwork-place-qualifiers',
                'model' => \App\Models\Collections\ArtworkPlaceQualifier::class,
            ],
            [
                'endpoint' => 'artwork-date-qualifiers',
                'model' => \App\Models\Collections\ArtworkDateQualifier::class,
            ],
            [
                'endpoint' => 'places',
                'model' => \App\Models\Collections\Place::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'catalogues',
                'model' => \App\Models\Collections\Catalogue::class,
            ],
            [
                'endpoint' => 'artwork-catalogues',
                'model' => \App\Models\Collections\ArtworkCatalogue::class,
            ],
            [
                'endpoint' => 'galleries',
                'model' => \App\Models\Collections\Gallery::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'exhibitions',
                'model' => \App\Models\Collections\Exhibition::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'exhibition-agents',
                'model' => \App\Models\Collections\AgentExhibition::class,
            ],
            [
                'endpoint' => 'category-terms',
                'model' => \App\Models\Collections\CategoryTerm::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'terms',
                'model' => \App\Models\Collections\Term::class,
                'scope_of' => 'category-terms',
            ],
            [
                'endpoint' => 'categories',
                'model' => \App\Models\Collections\Category::class,
                'scope_of' => 'category-terms',
            ],
            [
                'endpoint' => 'departments',
                'model' => \App\Models\Collections\Category::class,
                'scope_of' => 'categories',
            ],
            [
                'endpoint' => 'assets',
                'model' => \App\Models\Collections\Asset::class,
            ],
            [
                'endpoint' => 'images',
                'model' => \App\Models\Collections\Image::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'videos',
                'model' => \App\Models\Collections\Video::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'sounds',
                'model' => \App\Models\Collections\Sound::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'texts',
                'model' => \App\Models\Collections\Text::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'shop-categories',
                'model' => \App\Models\Shop\Category::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'products',
                'model' => \App\Models\Shop\Product::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'legacy-events',
                'model' => \App\Models\Membership\LegacyEvent::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'ticketed-events',
                'model' => \App\Models\Membership\TicketedEvent::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'ticketed-event-types',
                'model' => \App\Models\Membership\TicketedEventType::class,
            ],
            [
                'endpoint' => 'tours',
                'model' => \App\Models\Mobile\Tour::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'tour-stops',
                'model' => \App\Models\Mobile\TourStop::class,
            ],
            [
                'endpoint' => 'mobile-sounds',
                'model' => \App\Models\Mobile\Sound::class,
            ],
            [
                'endpoint' => 'publications',
                'model' => \App\Models\Dsc\Publication::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'sections',
                'model' => \App\Models\Dsc\Section::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'sites',
                'model' => \App\Models\StaticArchive\Site::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'library-materials',
                'model' => \App\Models\Library\Material::class,
            ],
            [
                'endpoint' => 'library-terms',
                'model' => \App\Models\Library\Term::class,
            ],
            [
                'endpoint' => 'archive-images',
                'model' => \App\Models\Archive\ArchiveImage::class,
            ],
            [
                'endpoint' => 'tags',
                'model' => \App\Models\Web\Tag::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'locations',
                'model' => \App\Models\Web\Location::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'hours',
                'model' => \App\Models\Web\Hour::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'closures',
                'model' => \App\Models\Web\Closure::class,
                'is_searchable' => true, // TODO: Verify?
            ],
            [
                'endpoint' => 'web-exhibitions',
                'model' => \App\Models\Web\Exhibition::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'events',
                'model' => \App\Models\Web\Event::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'articles',
                'model' => \App\Models\Web\Article::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'selections',
                'model' => \App\Models\Web\Selection::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'web-artists',
                'model' => \App\Models\Web\Artist::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'generic-pages',
                'model' => \App\Models\Web\GenericPage::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'press-releases',
                'model' => \App\Models\Web\PressRelease::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'research-guides',
                'model' => \App\Models\Web\ResearchGuide::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'educator-resources',
                'model' => \App\Models\Web\EducatorResource::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'digital-catalogs',
                'model' => \App\Models\Web\DigitalCatalog::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'printed-catalogs',
                'model' => \App\Models\Web\PrintedCatalog::class,
                'is_searchable' => true,
            ],
        ],

    ],

];
