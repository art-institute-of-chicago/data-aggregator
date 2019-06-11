<?php

return [
    'dsn' => env('SENTRY_LARAVEL_DSN'),

    // capture release as git sha
    // 'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),

    'breadcrumbs' => [

        // Capture bindings on SQL queries
        'sql_bindings' => true,

    ],

];
