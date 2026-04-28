<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    /**
     * Allow the marketing site + customer dashboard + localhost dev.
     * Update for production by setting ALLOWED_ORIGINS in .env (comma-separated).
     */
    'allowed_origins' => array_filter(array_merge(
        [
            env('MARKETING_SITE_URL', 'https://protiddhoni-bd.com'),
            env('CUSTOMER_DASHBOARD_URL', 'https://app.protiddhoni-bd.com'),
            'http://localhost',
            'http://localhost:8000',
            'http://127.0.0.1',
            'http://127.0.0.1:8000',
            'http://127.0.0.1:5500',  // VS Code Live Server default
        ],
        explode(',', (string) env('ALLOWED_ORIGINS', ''))
    )),

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
