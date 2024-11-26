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
        'version' => env(key: 'AZURE_EMBEDDING_API_VERSION')
    ],
    'image_embedding' => [
        'endpoint' => env(key: 'AZURE_IMAGE_EMBEDDING_API_ENDPOINT'),
        'key' => env(key: 'AZURE_IMAGE_EMBEDDING_API_KEY'),
        'version' => env(key: 'AZURE_IMAGE_EMBEDDING_API_VERSION'),
    ],
    'image_analysis' => [
        'endpoint' => env(key: 'AZURE_IMAGE_ANALYSIS_API_ENDPOINT'),
        'key' => env(key: 'AZURE_IMAGE_ANALYSIS_API_KEY'),
        'version' => env(key: 'AZURE_IMAGE_ANALYSIS_API_VERSION'),
    ],
    'completion' => [
        'endpoint' => env(key: 'AZURE_COMPLETIONS_API_ENDPOINT'),
        'key' => env(key: 'AZURE_COMPLETIONS_API_KEY'),
        'version' => env(key: 'AZURE_COMPLETIONS_API_VERSION'),
    ],

];
