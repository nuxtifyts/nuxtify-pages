<?php

return [
    'models' => [
        'tag' => [
            'fields' => [
                'name' => 'Name',
            ]
        ],
        'category' => [
            'fields' => [
                'parent' => 'Parent category',
                'name' => 'Name',
                'metadata' => 'Additional data',
                'description' => 'Description',
                'related_categories' => 'Related categories',
            ]
        ],
        'related-category' => [
            'fields' => [
                'relation' => 'Relationship',
            ],
        ],
        'page' => [
            'fields' => [
                'slug' => 'Slug',
                'title' => 'Title',
                'description' => 'Description',
                'layout_id' => 'Page layout',
                'status' => 'Status',
                'visibility' => 'Visibility',
                'published_at' => 'Published at',
                'tags' => 'Tags',
                'categories' => 'Categories',
                'metadata' => [
                    'title' => 'Title',
                    'description' => 'Description',
                    'keywords' => 'Keywords',
                    'author' => 'Author',
                ]
            ],
            'sections' => [
                'page-information' => 'Page information',
                'seo' => 'SEO',
                'tags_and_categories' => 'Tags and categories',
                'page-elements' => 'Page elements',
            ],
            'block-name' => [
                'paragraph' => 'Paragraph',
                'heading' => 'Heading',
                'image' => 'Image',
            ],
            'blocks' => [
                'paragraph' => [
                    'content' => 'Content',
                ],
                'heading' => [
                    'content' => 'Content',
                    'level' => 'Level',
                    'h1' => 'Heading 1',
                    'h2' => 'Heading 2',
                    'h3' => 'Heading 3',
                    'h4' => 'Heading 4',
                    'h5' => 'Heading 5',
                    'h6' => 'Heading 6',
                ],
                'image' => [
                    'src' => 'Image',
                    'alt' => 'Alt text',
                    'width' => 'Width',
                    'height' => 'Height',
                ]
            ]
        ],
        'layout' => [
            'fields' => [
                'code' => 'Code',
            ],
            'block-name' => [
                'slot' => 'Page content',
            ]
        ]
    ],
    'enums' => [
        'category-relation' => [
            'parent' => 'Parent',
            'child' => 'Child',
            'related' => 'Related',
        ],
        'page-visibility' => [
            'public' => 'Public',
            'private' => 'Private',
        ],
        'page-status' => [
            'draft' => 'Draft',
            'archived' => 'Archived',
            'pending' => 'Pending',
            'published' => 'Published',
        ]
    ],
    'actions' => [
        'read' => 'Read',
    ]
];
