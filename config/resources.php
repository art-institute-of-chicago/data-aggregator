<?php

return [

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
                'endpoint' => 'artwork-dates',
                'model' => \App\Models\Collections\ArtworkDate::class,
                'is_searchable' => true, // TODO: Verify?
            ],
            [
                'endpoint' => 'categories',
                'model' => \App\Models\Collections\Category::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'departments',
                'model' => \App\Models\Collections\Category::class,
                'scope_of' => 'categories',
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
                'endpoint' => 'terms',
                'model' => \App\Models\Collections\Term::class,
                'is_searchable' => true,
            ],
            [
                'endpoint' => 'term-types',
                'model' => \App\Models\Collections\TermType::class,
            ],
            [
                'endpoint' => 'category-terms',
                'model' => \App\Models\Collections\CategoryTerm::class,
                'is_searchable' => true, // TODO: Verify?
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
                'endpoint' => 'links',
                'model' => \App\Models\Collections\Link::class,
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
                'endpoint' => 'pages',
                'model' => \App\Models\Web\Page::class,
                'is_searchable' => true,
            ],
        ],

    ],

];
