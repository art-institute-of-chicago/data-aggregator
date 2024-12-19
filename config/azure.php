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
    'status' => env(key: 'AI_SERVICES_ENABLED'),

    'embedding' => [
        'endpoint' => env(key: 'AZURE_EMBEDDING_API_ENDPOINT'),
        'key' => env(key: 'AZURE_EMBEDDING_API_KEY'),
        'version' => env(key: 'AZURE_EMBEDDING_API_VERSION', default: '2023-05-15')
    ],
    'image_embedding' => [
        'endpoint' => env(key: 'AZURE_IMAGE_EMBEDDING_API_ENDPOINT'),
        'key' => env(key: 'AZURE_IMAGE_EMBEDDING_API_KEY'),
        'version' => env(key: 'AZURE_IMAGE_EMBEDDING_API_VERSION', default: '2023-04-15'),
    ],
    'image_analysis' => [
        'endpoint' => env(key: 'AZURE_IMAGE_ANALYSIS_API_ENDPOINT'),
        'key' => env(key: 'AZURE_IMAGE_ANALYSIS_API_KEY'),
        'version' => env(key: 'AZURE_IMAGE_ANALYSIS_API_VERSION', default: '2024-02-01'),
    ],
    'completion' => [
        'endpoint' => env(key: 'AZURE_COMPLETIONS_API_ENDPOINT'),
        'key' => env(key: 'AZURE_COMPLETIONS_API_KEY'),
        'version' => env(key: 'AZURE_COMPLETIONS_API_VERSION', default: '2024-08-01'),
    ],

];
