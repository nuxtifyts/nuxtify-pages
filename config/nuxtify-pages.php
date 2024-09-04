<?php

return [
    'locales' => ['en'],

    /**
     * Allow the user to select a custom layout for a page
     */
    'custom_layouts' => [
        'enabled' => true,
    ],

    'tags_navigation' => false,
    'layouts_navigation' => false,

    'default_layout' => [
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
    ],

    'api-routes' => [
        'enabled' => true,
        'prefix' => '/api',
    ],

    'database' => [
        'prefix' => 'nuxtify_pages',
    ],

    'pages' => [
        'default_visibility' => 'private',
        'default_status' => 'draft',
    ],
];
