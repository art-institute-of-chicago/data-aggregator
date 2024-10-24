<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Azure Authentication Endpoints & Keys
    |--------------------------------------------------------------------------
    |
    | Configuration endpoints and keys for Azure AI Cognitive Services
    |
    */

    'embedding' => [
        'endpoint' => env(key: 'AZURE_EMBEDDING_API_ENDPOINT'),
        'key' => env(key: 'AZURE_EMBEDDING_API_KEY'),
    ],
    'image_analysis' => [
        'endpoint' => env(key: 'AZURE_IMAGE_ANALYSIS_API_ENDPOINT'),
        'key' => env(key: 'AZURE_IMAGE_ANALYSIS_API_KEY'),
    ],
    'completion' => [
        'endpoint' => env(key: 'AZURE_COMPLETIONS_API_ENDPOINT'),
        'key' => env(key: 'AZURE_COMPLETIONS_API_KEY'),
    ],

];
