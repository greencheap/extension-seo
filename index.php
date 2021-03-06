<?php
return [
    'name' => 'seo',

    'autoload' => [
        'GreenCheap\\SEO\\' => 'src'
    ],

    'menu' => [
        //'seo' => [
            //'label' => 'Seo',
            //'icon' => 'seo:icon.svg',
            //'url' => '@seo/admin',
            //'active' => '@seo/admin',
            //'access' => 'seo: module management access',
            //'priority' => 115
        //]
    ],

    'routes' => [
        '/seo' => [
            'name' => '@seo',
            'controller' => [
                'GreenCheap\\SEO\\Controller\\SitemapController',
                //'GreenCheap\\SEO\\Controller\\Admin\\SeoController'
            ]
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

    'permissions' => [
        'seo: module management access' => [
            'title' => 'Module management'
        ],

        'seo: redirect management' => [
            'title' => 'Redirect management'
        ]
    ],

    'events' => [
        'view.system/site/admin/edit' => function($event, $view) {
            $view->script('seo-node-meta', 'seo:app/bundle/modules/node-meta.js', 'site-edit');
        },

        'view.scripts' => function($event , $scripts) {
            $scripts->register('seo-categories-meta', 'seo:app/bundle/modules/categories-meta.js', '~categories-edit');
            $scripts->register('seo-blog-meta', 'seo:app/bundle/modules/blog-meta.js', '~post-edit');
            $scripts->register('seo-docs-meta', 'seo:app/bundle/modules/docs-meta.js', '~docs_admin_edit');
            $scripts->register('seo-settings', 'seo:app/bundle/seo-settings.js', ['~extensions', 'input-tree']);
        },

        'view.meta' => [function ($event, $meta) use ($app) {
            if($meta->get('og:title')){
                $title[] = $app->config('system/site')->get('title');
                $title[] = $meta->get('og:title');

                if ($app->request()->getPathInfo() === '/') {
                    $title = array_reverse($title);
                }

                $meta->add('title', implode(' | ', $title));
            }else{
                if ($meta->get('title')) {
                    $title[] = $meta->get('title');
                }

                $title[] = $app->config('system/site')->get('title');
                if ($app->request()->getPathInfo() === '/') {
                    $title = array_reverse($title);
                }

                $meta->add('title', implode(' | ', $title));
            }
        }, -51]
    ],
];
