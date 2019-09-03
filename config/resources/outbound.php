<?php

return [

    'base' => [

        /**
         * Complex collection models:
         */
        [
            'endpoint' => 'artworks',
            'model' => \App\Models\Collections\Artwork::class,
            'transformer' => \App\Transformers\Outbound\Collections\Artwork::class,
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
            'transformer' => \App\Transformers\Outbound\Collections\Place::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'galleries',
            'model' => \App\Models\Collections\Gallery::class,
            'transformer' => \App\Transformers\Outbound\Collections\Gallery::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'exhibitions',
            'model' => \App\Models\Collections\Exhibition::class,
            'transformer' => \App\Transformers\Outbound\Collections\Exhibition::class,
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
        [
            'endpoint' => 'catalogues',
            'model' => \App\Models\Collections\Catalogue::class,
            'transformer' => \App\Transformers\Outbound\CollectionsTransformer::class,
        ],

        /**
         * Lists with additional fields:
         */
        [
            'endpoint' => 'category-terms',
            'model' => \App\Models\Collections\CategoryTerm::class,
            'transformer' => \App\Transformers\Outbound\Collections\CategoryTerm::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'terms',
            'model' => \App\Models\Collections\Term::class,
            'transformer' => \App\Transformers\Outbound\Collections\CategoryTerm::class,
            'scope_of' => 'category-terms',
        ],
        [
            'endpoint' => 'categories',
            'model' => \App\Models\Collections\Category::class,
            'transformer' => \App\Transformers\Outbound\Collections\CategoryTerm::class,
            'scope_of' => 'category-terms',
        ],
        [
            'endpoint' => 'departments',
            'model' => \App\Models\Collections\Category::class,
            'transformer' => \App\Transformers\Outbound\Collections\CategoryTerm::class,
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
            'transformer' => \App\Transformers\Outbound\Collections\Asset::class,
        ],
        [
            'endpoint' => 'images',
            'model' => \App\Models\Collections\Image::class,
            'transformer' => \App\Transformers\Outbound\Collections\Image::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'videos',
            'model' => \App\Models\Collections\Video::class,
            'transformer' => \App\Transformers\Outbound\Collections\Asset::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'sounds',
            'model' => \App\Models\Collections\Sound::class,
            'transformer' => \App\Transformers\Outbound\Collections\Asset::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'texts',
            'model' => \App\Models\Collections\Text::class,
            'transformer' => \App\Transformers\Outbound\Collections\Asset::class,
            'is_searchable' => true,
        ],

        /**
         * Shop:
         */
        [
            'endpoint' => 'shop-categories',
            'model' => \App\Models\Shop\Category::class,
            'transformer' => \App\Transformers\Outbound\Shop\Category::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'products',
            'model' => \App\Models\Shop\Product::class,
            'transformer' => \App\Transformers\Outbound\Shop\Product::class,
            'is_searchable' => true,
        ],

        /**
         * Ticketing:
         */
        [
            'endpoint' => 'ticketed-events',
            'model' => \App\Models\Membership\TicketedEvent::class,
            'transformer' => \App\Transformers\Outbound\Membership\TicketedEvent::class,
            'is_restricted' => true,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'ticketed-event-types',
            'model' => \App\Models\Membership\TicketedEventType::class,
            'transformer' => \App\Transformers\Outbound\Membership\TicketedEventType::class,
            'is_restricted' => true,
        ],
        [
            'endpoint' => 'legacy-events',
            'alias_of' => 'event-occurrences',
        ],

        /**
         * Mobile:
         */
        [
            'endpoint' => 'tours',
            'model' => \App\Models\Mobile\Tour::class,
            'transformer' => \App\Transformers\Outbound\Mobile\Tour::class,
            'is_searchable' => true,
        ],
        [
            'model' => \App\Models\Mobile\TourStop::class,
            'transformer' => \App\Transformers\Outbound\Mobile\TourStop::class,
        ],
        [
            'endpoint' => 'mobile-sounds',
            'model' => \App\Models\Mobile\Sound::class,
            'transformer' => \App\Transformers\Outbound\Mobile\Sound::class,
            'is_searchable' => true,
        ],

        /**
         * Digital scholarly publications:
         */
        [
            'endpoint' => 'publications',
            'model' => \App\Models\Dsc\Publication::class,
            'transformer' => \App\Transformers\Outbound\Dsc\Publication::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'sections',
            'model' => \App\Models\Dsc\Section::class,
            'transformer' => \App\Transformers\Outbound\Dsc\Section::class,
            'is_searchable' => true,
        ],

        /**
         * Static site archive:
         */
        [
            'endpoint' => 'sites',
            'model' => \App\Models\StaticArchive\Site::class,
            'transformer' => \App\Transformers\Outbound\StaticArchive\Site::class,
            'is_searchable' => true,
        ],

        /**
         * Library and archives:
         */
        [
            'endpoint' => 'library-materials',
            'model' => \App\Models\Library\Material::class,
            'transformer' => \App\Transformers\Outbound\Library\Material::class,
        ],
        [
            'endpoint' => 'library-terms',
            'model' => \App\Models\Library\Term::class,
            'transformer' => \App\Transformers\Outbound\Library\Term::class,
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
            'endpoint' => 'hours',
            'model' => \App\Models\Web\Hour::class,
            'transformer' => \App\Transformers\Outbound\Web\Hour::class,
            'is_restricted' => true,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'closures',
            'model' => \App\Models\Web\Closure::class,
            'transformer' => \App\Transformers\Outbound\Web\Closure::class,
            'is_searchable' => true, // TODO: Verify?
        ],
        [
            'endpoint' => 'web-exhibitions',
            'model' => \App\Models\Web\Exhibition::class,
            'transformer' => \App\Transformers\Outbound\Web\Exhibition::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'experiences',
            'model' => \App\Models\Web\Experience::class,
            'transformer' => \App\Transformers\Outbound\Web\Experience::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'events',
            'model' => \App\Models\Web\Event::class,
            'transformer' => \App\Transformers\Outbound\Web\Event::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'event-occurrences',
            'model' => \App\Models\Web\EventOccurrence::class,
            'transformer' => \App\Transformers\Outbound\Web\EventOccurrence::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'event-programs',
            'model' => \App\Models\Web\EventProgram::class,
            'transformer' => \App\Transformers\Outbound\Web\EventProgram::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'email-series',
            'model' => \App\Models\Web\EmailSeries::class,
            'transformer' => \App\Transformers\Outbound\GenericTransformer::class,
            'is_restricted' => true,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'interactive-features',
            'model' => \App\Models\Web\InteractiveFeature::class,
            'transformer' => \App\Transformers\Outbound\Web\InteractiveFeature::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'sponsors',
            'model' => \App\Models\Web\Sponsor::class,
            'transformer' => \App\Transformers\Outbound\Web\Sponsor::class,
            'is_restricted' => true,
            'is_searchable' => true,
        ],
        [
            'model' => \App\Models\Web\EventEmailSeriesPivot::class,
            'transformer' => \App\Transformers\Outbound\Web\EventEmailSeriesPivot::class,
        ],
        [
            'endpoint' => 'articles',
            'model' => \App\Models\Web\Article::class,
            'transformer' => \App\Transformers\Outbound\Web\Article::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'selections',
            'model' => \App\Models\Web\Selection::class,
            'transformer' => \App\Transformers\Outbound\Web\Selection::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'web-artists',
            'model' => \App\Models\Web\Artist::class,
            'transformer' => \App\Transformers\Outbound\Web\Artist::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'static-pages',
            'model' => \App\Models\Web\StaticPage::class,
            'transformer' => \App\Transformers\Outbound\Web\StaticPage::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'generic-pages',
            'model' => \App\Models\Web\GenericPage::class,
            'transformer' => \App\Transformers\Outbound\Web\GenericPage::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'press-releases',
            'model' => \App\Models\Web\PressRelease::class,
            'transformer' => \App\Transformers\Outbound\Web\Page::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'educator-resources',
            'model' => \App\Models\Web\EducatorResource::class,
            'transformer' => \App\Transformers\Outbound\Web\Page::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'digital-catalogs',
            'model' => \App\Models\Web\DigitalCatalog::class,
            'transformer' => \App\Transformers\Outbound\Web\Page::class,
            'is_searchable' => true,
        ],
        [
            'endpoint' => 'printed-catalogs',
            'model' => \App\Models\Web\PrintedCatalog::class,
            'transformer' => \App\Transformers\Outbound\Web\Page::class,
            'is_searchable' => true,
        ],

    ],

];
