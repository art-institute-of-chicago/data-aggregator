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

    'images' => [
        'images' => [
            'model' => \App\Models\Collections\Image::class,
            'transformer' => \App\Transformers\Inbound\Images\Image::class,
        ],
    ],

    'archive' => [
        'archival-images' => [
            'model' => \App\Models\Archive\ArchiveImage::class,
            'transformer' => \App\Transformers\Inbound\BaseTransformer::class,
        ],
    ],

    'library' => [
        'terms' => [
            'model' => \App\Models\Library\Term::class,
            'transformer' => \App\Transformers\Inbound\BaseTransformer::class,
        ],
        'materials' => [
            'model' => \App\Models\Library\Material::class,
            'transformer' => \App\Transformers\Inbound\Library\Material::class,
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
        'categories' => [
            'model' => \App\Models\Shop\Category::class,
            'transformer' => \App\Transformers\Inbound\Shop\Category::class,
        ],
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

    'web' => [
        'articles' => [
            'model' => \App\Models\Web\Article::class,
            'transformer' => \App\Transformers\Inbound\Web\Article::class,
        ],
        'artists' => [
            'model' => \App\Models\Web\Artist::class,
            'transformer' => \App\Transformers\Inbound\Web\Artist::class,
        ],
        // TODO: Consider deleting until needed.
        'closures' => [
            'model' => \App\Models\Web\Closure::class,
            'transformer' => \App\Transformers\Inbound\Web\Closure::class,
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
        'emailseries' => [
            'model' => \App\Models\Web\EmailSeries::class,
            'transformer' => \App\Transformers\Inbound\WebTransformer::class,
        ],
        'sponsors' => [
            'model' => \App\Models\Web\Sponsor::class,
            'transformer' => \App\Transformers\Inbound\WebTransformer::class,
        ],
        'exhibitions' => [
            'model' => \App\Models\Web\Exhibition::class,
            'transformer' => \App\Transformers\Inbound\Web\Exhibition::class,
        ],
        // TODO: Consider deleting until needed.
        'hours' => [
            'model' => \App\Models\Web\Hour::class,
            'transformer' => \App\Transformers\Inbound\Web\Hour::class
        ],
        // TODO: Consider deleting until needed.
        'locations' => [
            'model' => \App\Models\Web\Location::class,
            'transformer' => \App\Transformers\Inbound\WebTransformer::class,
        ],
        'selections' => [
            'model' => \App\Models\Web\Selection::class,
            'transformer' => \App\Transformers\Inbound\Web\Selection::class
        ],
        // TODO: This is empty and has no stakeholders. Let's delete.
        'tags' => [
            'model' => \App\Models\Web\Tag::class,
            'transformer' => \App\Transformers\Inbound\WebTransformer::class,
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
        'researchguides' => [
            'model' => \App\Models\Web\ResearchGuide::class,
            'transformer' => \App\Transformers\Inbound\Web\Page::class,
        ],
        'educatorresources' => [
            'model' => \App\Models\Web\EducatorResource::class,
            'transformer' => \App\Transformers\Inbound\Web\Page::class,
        ],
        'digitalpublications' => [
            'model' => \App\Models\Web\DigitalCatalog::class,
            'transformer' => \App\Transformers\Inbound\Web\Page::class,
        ],
        'printedpublications' => [
            'model' => \App\Models\Web\PrintedCatalog::class,
            'transformer' => \App\Transformers\Inbound\Web\Page::class,
        ],
    ],

];
