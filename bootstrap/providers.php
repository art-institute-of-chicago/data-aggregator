<?php

return [
    App\Providers\AppServiceProvider::class,

    /**
     * Override default Laravel Service Providers...
     */
    Aic\Hub\Foundation\Providers\DatabaseServiceProvider::class,
    Aic\Hub\Foundation\Providers\AuthServiceProvider::class,

    /**
     * Package Service Providers...
     */
    Laravel\Tinker\TinkerServiceProvider::class,
    Laravel\Scout\ScoutServiceProvider::class,
    MarkTopper\DoctrineDBALTimestampType\Laravel5ServiceProvider::class,

    /**
     * Foundation Service Providers...
     */
    Aic\Hub\Foundation\Providers\ResourceServiceProvider::class,

    /**
     * Application Service Providers...
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\FakerServiceProvider::class,
    App\Providers\SearchServiceProvider::class,
    App\Providers\ResourceServiceProvider::class,
    App\Providers\ElasticsearchProvider::class,
];
