<?php

return [

    'collections' => [
        'artwork-agent-roles' => [
            'model' => \App\Models\Collections\AgentRole::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        'artwork-date-qualifiers' => [
            'model' => \App\Models\Collections\ArtworkDateQualifier::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        'artwork-place-qualifiers' => [
            'model' => \App\Models\Collections\ArtworkPlaceQualifier::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        'agent-place-qualifiers' => [
            'model' => \App\Models\Collections\AgentPlaceQualifier::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        'object-types' => [
            'model' => \App\Models\Collections\ArtworkType::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        'agent-types' => [
            'model' => \App\Models\Collections\AgentType::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        'catalogues' => [
            'model' => \App\Models\Collections\Catalogue::class,
            'transformer' => \App\Transformers\Inbound\Collections\BaseList::class,
        ],
        'categories' => [
            'model' => \App\Models\Collections\Category::class,
            'transformer' => \App\Transformers\Inbound\Collections\Category::class,
        ],
        'terms' => [
            'model' => \App\Models\Collections\Term::class,
            'transformer' => \App\Transformers\Inbound\Collections\Term::class,
        ],
        'places' => [
            'model' => \App\Models\Collections\Place::class,
            'transformer' => \App\Transformers\Inbound\CollectionsTransformer::class,
        ],
        'galleries' => [
            'model' => \App\Models\Collections\Gallery::class,
            'transformer' => \App\Transformers\Inbound\CollectionsTransformer::class,
        ],
        'agents' => [
            'model' => \App\Models\Collections\Agent::class,
            'transformer' => \App\Transformers\Inbound\Collections\Agent::class,
        ],
        'exhibitions' => [
            'model' => \App\Models\Collections\Exhibition::class,
            'transformer' => \App\Transformers\Inbound\Collections\Exhibition::class,
        ],
        'artworks' => [
            'model' => \App\Models\Collections\Artwork::class,
            'transformer' => \App\Transformers\Inbound\Collections\Artwork::class,
        ],
    ],

    'assets' => [
        'images' => [
            'model' => \App\Models\Collections\Image::class,
            'transformer' => \App\Transformers\Inbound\Collections\Asset::class,
        ],
        'sounds' => [
            'model' => \App\Models\Collections\Sound::class,
            'transformer' => \App\Transformers\Inbound\Collections\Asset::class,
        ],
        'videos' => [
            'model' => \App\Models\Collections\Video::class,
            'transformer' => \App\Transformers\Inbound\Collections\Asset::class,
        ],
        'texts' => [
            'model' => \App\Models\Collections\Text::class,
            'transformer' => \App\Transformers\Inbound\Collections\Asset::class,
        ],
    ],

    'enhancer' => [
        'agents' => [
            'model' => \App\Models\Collections\Agent::class,
            'transformer' => \App\Transformers\Inbound\Enhancer\Agent::class,
        ],
        'artworks' => [
            'model' => \App\Models\Collections\Artwork::class,
            'transformer' => \App\Transformers\Inbound\Enhancer\Artwork::class,
        ],
        'artwork-types' => [
            'model' => \App\Models\Collections\ArtworkType::class,
            'transformer' => \App\Transformers\Inbound\Enhancer\ArtworkType::class,
        ],
        'places' => [
            'model' => \App\Models\Collections\Place::class,
            'transformer' => \App\Transformers\Inbound\Enhancer\Place::class,
        ],
        'terms' => [
            'model' => \App\Models\Collections\CategoryTerm::class,
            'transformer' => \App\Transformers\Inbound\Enhancer\Term::class,
        ],
    ],

    'images' => [
        'images' => [
            'model' => \App\Models\Collections\Image::class,
            'transformer' => \App\Transformers\Inbound\Images\Image::class,
        ],
    ],

    'analytics' => [
        'artworks' => [
            'model' => \App\Models\Collections\Artwork::class,
            'transformer' => \App\Transformers\Inbound\Analytics\Artwork::class,
        ],
    ],

    'dsc' => [
        'publications' => [
            'model' => \App\Models\Dsc\Publication::class,
            'transformer' => \App\Transformers\Inbound\DscTransformer::class,
        ],
        'sections' => [
            'model' => \App\Models\Dsc\Section::class,
            'transformer' => \App\Transformers\Inbound\Dsc\Section::class,
        ],
    ],

    'shop' => [
        'products' => [
            'model' => \App\Models\Shop\Product::class,
            'transformer' => \App\Transformers\Inbound\Shop\Product::class,
        ],
    ],

    'membership' => [
        'event-types' => [
            'model' => \App\Models\Membership\TicketedEventType::class,
            'transformer' => \App\Transformers\Inbound\MembershipTransformer::class,
        ],
        'events' => [
            'model' => \App\Models\Membership\TicketedEvent::class,
            'transformer' => \App\Transformers\Inbound\Membership\TicketedEvent::class,
        ],
    ],

    'queues' => [
        'wait-times' => [
            'model' => \App\Models\Queues\WaitTime::class,
            'transformer' => \App\Transformers\Inbound\Queues\WaitTime::class,
        ],
    ],

    'web' => [
        'articles' => [
            'model' => \App\Models\Web\Article::class,
            'transformer' => \App\Transformers\Inbound\Web\Article::class,
        ],
        'artists' => [
            'model' => \App\Models\Web\Artist::class,
            'transformer' => \App\Transformers\Inbound\Web\Artist::class,
        ],
        'events' => [
            'model' => \App\Models\Web\Event::class,
            'transformer' => \App\Transformers\Inbound\Web\Event::class,
        ],
        'event-occurrences' => [
            'model' => \App\Models\Web\EventOccurrence::class,
            'transformer' => \App\Transformers\Inbound\Web\EventOccurrence::class,
            'exclude_from_import' => true,
        ],
        'event-programs' => [
            'model' => \App\Models\Web\EventProgram::class,
            'transformer' => \App\Transformers\Inbound\Web\EventProgram::class,
        ],
        'exhibitions' => [
            'model' => \App\Models\Web\Exhibition::class,
            'transformer' => \App\Transformers\Inbound\Web\Exhibition::class,
        ],
        'experiences' => [
            'model' => \App\Models\Web\Experience::class,
            'transformer' => \App\Transformers\Inbound\Web\Experience::class,
        ],
        'interactive-features' => [
            'model' => \App\Models\Web\InteractiveFeature::class,
            'transformer' => \App\Transformers\Inbound\Web\InteractiveFeature::class,
        ],
        'highlights' => [
            'model' => \App\Models\Web\Highlight::class,
            'transformer' => \App\Transformers\Inbound\Web\Highlight::class,
        ],
        'staticpages' => [
            'model' => \App\Models\Web\StaticPage::class,
            'transformer' => \App\Transformers\Inbound\Web\StaticPage::class,
        ],
        'genericpages' => [
            'model' => \App\Models\Web\GenericPage::class,
            'transformer' => \App\Transformers\Inbound\Web\Page::class,
        ],
        'pressreleases' => [
            'model' => \App\Models\Web\PressRelease::class,
            'transformer' => \App\Transformers\Inbound\Web\Page::class,
        ],
        'educatorresources' => [
            'model' => \App\Models\Web\EducatorResource::class,
            'transformer' => \App\Transformers\Inbound\Web\PageWithRelatedArtists::class,
        ],
        'digitalpublications' => [
            'model' => \App\Models\Web\DigitalCatalog::class,
            'transformer' => \App\Transformers\Inbound\Web\PageWithRelatedArtists::class,
        ],
        'printedpublications' => [
            'model' => \App\Models\Web\PrintedCatalog::class,
            'transformer' => \App\Transformers\Inbound\Web\PageWithRelatedArtists::class,
        ],
        'digitalpublicationsections' => [
            'model' => \App\Models\Web\DigitalPublicationSection::class,
            'transformer' => \App\Transformers\Inbound\Web\DigitalPublicationSection::class,
        ],
        'issues' => [
            'model' => \App\Models\Web\Issue::class,
            'transformer' => \App\Transformers\Inbound\Web\Issue::class,
        ],
        'issue-articles' => [
            'model' => \App\Models\Web\IssueArticle::class,
            'transformer' => \App\Transformers\Inbound\Web\IssueArticle::class,
        ],
    ],

];
