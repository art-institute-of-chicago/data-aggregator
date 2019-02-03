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

    // Currently, you can use these selectively to override inbound transformer inferences
    'inbound' => [
        //artwork-place-qualifiers
        [
            'source' => 'Collections',
            'model' => \App\Models\Collections\ArtworkPlaceQualifier::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        //artwork-date-qualifiers
        [
            'source' => 'Collections',
            'model' => \App\Models\Collections\ArtworkDateQualifier::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        //artwork-agent-roles
        [
            'source' => 'Collections',
            'model' => \App\Models\Collections\AgentRole::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        //object-types
        [
            'source' => 'Collections',
            'model' => \App\Models\Collections\ArtworkType::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        //agent-types
        [
            'source' => 'Collections',
            'model' => \App\Models\Collections\AgentType::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        //categories
        [
            'source' => 'Collections',
            'model' => \App\Models\Collections\Category::class,
            'transformer' => \App\Transformers\Inbound\Collections\Category::class,
        ],
        //terms
        [
            'source' => 'Collections',
            'model' => \App\Models\Collections\Term::class,
            'transformer' => \App\Transformers\Inbound\Collections\Term::class,
        ],
        //catalogues
        [
            'source' => 'Collections',
            'model' => \App\Models\Collections\Catalogue::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
    ],

    'outbound' => [

        'base' => [

            /**
             * Complex collection models:
             */
            [
                'endpoint' => 'artworks',
                'model' => \App\Models\Collections\Artwork::class,
                'transformer' => \App\Http\Transformers\ArtworkTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'agents',
                'model' => \App\Models\Collections\Agent::class,
                'transformer' => \App\Transformers\Outbound\Collections\Agent::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'artists',
                'model' => \App\Models\Collections\Agent::class,
                'transformer' => \App\Transformers\Outbound\Collections\Agent::class,
                'scope_of' => 'agents',
            ],
            [
                'endpoint' => 'places',
                'model' => \App\Models\Collections\Place::class,
                'transformer' => \App\Http\Transformers\PlaceTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'galleries',
                'model' => \App\Models\Collections\Gallery::class,
                'transformer' => \App\Http\Transformers\GalleryTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'exhibitions',
                'model' => \App\Models\Collections\Exhibition::class,
                'transformer' => \App\Http\Transformers\ExhibitionTransformer::class,
                'is_searchable' => true,
            ],


            /**
             * Lists with just id + title:
             */
            [
                'endpoint' => 'agent-types',
                'model' => \App\Models\Collections\AgentType::class,
                'transformer' => \App\Transformers\Outbound\CollectionsTransformer::class,
            ],
            [
                'endpoint' => 'agent-roles',
                'model' => \App\Models\Collections\AgentRole::class,
                'transformer' => \App\Transformers\Outbound\CollectionsTransformer::class,
            ],
            [
                'endpoint' => 'artwork-types',
                'model' => \App\Models\Collections\ArtworkType::class,
                'transformer' => \App\Transformers\Outbound\CollectionsTransformer::class,
            ],
            [
                'endpoint' => 'artwork-place-qualifiers',
                'model' => \App\Models\Collections\ArtworkPlaceQualifier::class,
                'transformer' => \App\Transformers\Outbound\CollectionsTransformer::class,
            ],
            [
                'endpoint' => 'artwork-date-qualifiers',
                'model' => \App\Models\Collections\ArtworkDateQualifier::class,
                'transformer' => \App\Transformers\Outbound\CollectionsTransformer::class,
            ],

            /**
             * Lists with additional fields:
             */
            [
                'endpoint' => 'catalogues',
                'model' => \App\Models\Collections\Catalogue::class,
                'transformer' => \App\Transformers\Outbound\CollectionsTransformer::class,
            ],
            [
                'endpoint' => 'category-terms',
                'model' => \App\Models\Collections\CategoryTerm::class,
                'transformer' => \App\Http\Transformers\CollectionsTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'terms',
                'model' => \App\Models\Collections\Term::class,
                'transformer' => \App\Http\Transformers\CollectionsTransformer::class,
                'scope_of' => 'category-terms',
            ],
            [
                'endpoint' => 'categories',
                'model' => \App\Models\Collections\Category::class,
                'transformer' => \App\Http\Transformers\CollectionsTransformer::class,
                'scope_of' => 'category-terms',
            ],
            [
                'endpoint' => 'departments',
                'model' => \App\Models\Collections\Category::class,
                'transformer' => \App\Http\Transformers\CollectionsTransformer::class,
                'scope_of' => 'categories',
            ],

            /**
             * Pivot transformer mappings w/o endpoints:
             */
            [
                'model' => \App\Models\Collections\ArtworkArtistPivot::class,
                'transformer' => \App\Transformers\Outbound\Collections\ArtworkArtistPivot::class,
            ],
            [
                'model' => \App\Models\Collections\ArtworkCatalogue::class,
                'transformer' => \App\Transformers\Outbound\Collections\ArtworkCatalogue::class,
            ],
            [
                'model' => \App\Models\Collections\ArtworkDate::class,
                'transformer' => \App\Transformers\Outbound\Collections\ArtworkDate::class,
            ],
            [
                'model' => \App\Models\Collections\ArtworkPlacePivot::class,
                'transformer' => \App\Transformers\Outbound\Collections\ArtworkPlacePivot::class,
            ],

            /**
             * Assets from DAMS:
             */
            [
                'endpoint' => 'assets',
                'model' => \App\Models\Collections\Asset::class,
                'transformer' => \App\Http\Transformers\AssetTransformer::class,
            ],
            [
                'endpoint' => 'images',
                'model' => \App\Models\Collections\Image::class,
                'transformer' => \App\Http\Transformers\AssetTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'videos',
                'model' => \App\Models\Collections\Video::class,
                'transformer' => \App\Http\Transformers\AssetTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'sounds',
                'model' => \App\Models\Collections\Sound::class,
                'transformer' => \App\Http\Transformers\AssetTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'texts',
                'model' => \App\Models\Collections\Text::class,
                'transformer' => \App\Http\Transformers\AssetTransformer::class,
                'is_searchable' => true,
            ],

            /**
             * Shop:
             */
            [
                'endpoint' => 'shop-categories',
                'model' => \App\Models\Shop\Category::class,
                'transformer' => \App\Http\Transformers\ShopCategoryTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'products',
                'model' => \App\Models\Shop\Product::class,
                'transformer' => \App\Http\Transformers\ProductTransformer::class,
                'is_searchable' => true,
            ],

            /**
             * Legacy website:
             */
            [
                'endpoint' => 'legacy-events',
                'model' => \App\Models\Membership\LegacyEvent::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],

            /**
             * Ticketing:
             */
            [
                'endpoint' => 'ticketed-events',
                'model' => \App\Models\Membership\TicketedEvent::class,
                'transformer' => \App\Http\Transformers\TicketedEventTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'ticketed-event-types',
                'model' => \App\Models\Membership\TicketedEventType::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
            ],

            /**
             * Mobile:
             */
            [
                'endpoint' => 'tours',
                'model' => \App\Models\Mobile\Tour::class,
                'transformer' => \App\Http\Transformers\TourTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'tour-stops',
                'model' => \App\Models\Mobile\TourStop::class,
                'transformer' => \App\Http\Transformers\TourStopTransformer::class,
            ],
            [
                'endpoint' => 'mobile-sounds',
                'model' => \App\Models\Mobile\Sound::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
            ],

            /**
             * Digital scholarly publications:
             */
            [
                'endpoint' => 'publications',
                'model' => \App\Models\Dsc\Publication::class,
                'transformer' => \App\Http\Transformers\DscTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'sections',
                'model' => \App\Models\Dsc\Section::class,
                'transformer' => \App\Http\Transformers\DscTransformer::class,
                'is_searchable' => true,
            ],

            /**
             * Static site archive:
             */
            [
                'endpoint' => 'sites',
                'model' => \App\Models\StaticArchive\Site::class,
                'transformer' => \App\Http\Transformers\SiteTransformer::class,
                'is_searchable' => true,
            ],

            /**
             * Library and archives:
             */
            [
                'endpoint' => 'library-materials',
                'model' => \App\Models\Library\Material::class,
                'transformer' => \App\Http\Transformers\LibraryMaterialTransformer::class,
            ],
            [
                'endpoint' => 'library-terms',
                'model' => \App\Models\Library\Term::class,
                'transformer' => \App\Http\Transformers\LibraryTermTransformer::class,
            ],
            [
                'endpoint' => 'archive-images',
                'model' => \App\Models\Archive\ArchiveImage::class,
                'transformer' => \App\Transformers\Outbound\Archive\ArchiveImage::class,
            ],

            /**
             * Website:
             */
            [
                'endpoint' => 'tags',
                'model' => \App\Models\Web\Tag::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'locations',
                'model' => \App\Models\Web\Location::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'hours',
                'model' => \App\Models\Web\Hour::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'closures',
                'model' => \App\Models\Web\Closure::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true, // TODO: Verify?
            ],
            [
                'endpoint' => 'web-exhibitions',
                'model' => \App\Models\Web\Exhibition::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'events',
                'model' => \App\Models\Web\Event::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'event-occurrences',
                'model' => \App\Models\Web\EventOccurrence::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'event-programs',
                'model' => \App\Models\Web\EventProgram::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'articles',
                'model' => \App\Models\Web\Article::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'selections',
                'model' => \App\Models\Web\Selection::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'web-artists',
                'model' => \App\Models\Web\Artist::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'static-pages',
                'model' => \App\Models\Web\StaticPage::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'generic-pages',
                'model' => \App\Models\Web\GenericPage::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'press-releases',
                'model' => \App\Models\Web\PressRelease::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'research-guides',
                'model' => \App\Models\Web\ResearchGuide::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'educator-resources',
                'model' => \App\Models\Web\EducatorResource::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'digital-catalogs',
                'model' => \App\Models\Web\DigitalCatalog::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'printed-catalogs',
                'model' => \App\Models\Web\PrintedCatalog::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],

            /**
             * Digital labels:
             */
            [
                'endpoint' => 'digital-labels',
                'model' => \App\Models\DigitalLabel\Label::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
                'is_searchable' => true,
            ],
            // The following is needed for our inbound transformers, even though the
            // endpoint hasn't and doesn't need to be built out
            [
                'endpoint' => 'digital-label-exhibitions',
                'model' => \App\Models\DigitalLabel\Exhibition::class,
                'transformer' => \App\Http\Transformers\ApiTransformer::class,
            ],
        ],

    ],

];
