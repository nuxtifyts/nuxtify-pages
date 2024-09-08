<?php

return [
    'locales' => ['en'],

    'tags_navigation' => false,

    'layout' => [
        'name' => 'layouts.app',

        /**
         * The keys of the sections that could be used within the layout
         * Will only be used when using the default layout:
         * - 'meta' is used for meta tags
         * - 'content' is the main content of the page
         */
        'section-keys' => [
            'meta' => [
                'title',
                'description',
                'author',
                'keywords',
            ],
            'content',
        ]
    ],

    'web-routes' => [
        'enabled' => true,
        'prefix' => '/',
        'additional-middleware' => [],
    ],

    'api-routes' => [
        'enabled' => true,
        'prefix' => '/api',
        'additional-middleware' => [],
    ],

    'database' => [
        'prefix' => 'nuxtify_pages',
    ],

    'pages' => [
        'default_visibility' => 'private',
        'default_status' => 'draft',
    ],

    'pagination' => [
        'per_page' => 10,
    ]
];
