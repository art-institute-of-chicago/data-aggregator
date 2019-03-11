<?php

// Currently, you can use these selectively to override inbound transformer inferences
return [

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
    //catalogues
    [
        'source' => 'Collections',
        'model' => \App\Models\Collections\Catalogue::class,
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
    //images
    [
        'source' => 'Collections',
        'model' => \App\Models\Collections\Image::class,
        'transformer' => \App\Transformers\Inbound\Collections\Asset::class,
    ],
    // sounds
    [
        'source' => 'Collections',
        'model' => \App\Models\Collections\Sound::class,
        'transformer' => \App\Transformers\Inbound\Collections\Asset::class,
    ],
    // videos
    [
        'source' => 'Collections',
        'model' => \App\Models\Collections\Video::class,
        'transformer' => \App\Transformers\Inbound\Collections\Asset::class,
    ],
    // texts
    [
        'source' => 'Collections',
        'model' => \App\Models\Collections\Text::class,
        'transformer' => \App\Transformers\Inbound\Collections\Asset::class,
    ],

];
