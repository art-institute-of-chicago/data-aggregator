<?php

return [

    /**
     * Avoid defining fallbacks here! We want things to fail if `.env` is empty.
     */

    /**
     * Well-formed data services, suitable for bulk imports:
     */
    'collections' => env('COLLECTIONS_DATA_SERVICE_URL'),
    'assets' => env('ASSETS_DATA_SERVICE_URL'),
    'dsc' => env('ENHANCER_URL'), // See API-345
    'shop' => env('SHOP_DATA_SERVICE_URL'),
    'membership' => env('EVENTS_DATA_SERVICE_URL'),
    'web' => env('WEB_CMS_DATA_SERVICE_URL'),
    'analytics' => env('ANALYTICS_DATA_SERVICE_URL'),
    'queues' => env('QUEUES_DATA_SERVICE_URL'),
    'mobile' => env('MOBILE_JSON'),
    'static_archive' => env('STATIC_ARCHIVE_JSON'),

];
