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
        ],
    ],

    'routes' => [
        'index' => '',
        'show' => '',
    ],

    'database' => [
        'prefix' => 'nuxtify_pages',
    ],

    'pages' => [
        'default_visibility' => 'private',
        'default_status' => 'draft',
    ],
];
