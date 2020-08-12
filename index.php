<?php
return [
    'name' => 'seo',

    'autoload' => [
        'GreenCheap\\SEO\\' => 'src'
    ],

    'routes' => [
        '/seo' => [
            'name' => '@seo',
            'controller' => 'GreenCheap\\SEO\\Controller\\SitemapController'
        ],
        '/api/seo' => [
            'name' => '@api/seo',
            'controller' => 'GreenCheap\\SEO\\Controller\\ApiSitemapController'
        ]
    ],

    'settings' => 'seo-settings',

    'config' => [
        'sitemap' => [
            'sitemap_per_page' => 50
        ]
    ],

    'events' => [
        'view.system/site/admin/edit' => function($event, $view){
            $view->script('seo-node-meta', 'seo:app/bundle/modules/node-meta.js', 'site-edit');
        },

        'view.scripts' => function($event , $scripts){
            $scripts->register('seo-categories-meta', 'seo:app/bundle/modules/categories-meta.js', '~categories-edit');
            $scripts->register('seo-blog-meta', 'seo:app/bundle/modules/blog-meta.js', '~post-edit');
            $scripts->register('seo-docs-meta', 'seo:app/bundle/modules/docs-meta.js', '~docs_admin_edit');
            $scripts->register('seo-settings', 'seo:app/bundle/seo-settings.js', ['~extensions', 'input-tree']);
        },

    ],
];
