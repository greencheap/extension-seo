<?php
return [
    "name" => "seo",

    "autoload" => [
        "GreenCheap\\Seo\\" => "src",
    ],

    "nodes" => [
        'sitemap' => [
            'name' => '@sitemap',
            'label' => 'Sitemap',
            'controller' => 'GreenCheap\\Seo\\Controller\\SitemapController',
            'protected' => true,
            'frontpage' => true
        ]
    ],

    "sitemaps" => [
        'node' => [
            'name' => 'node',
            'generator' => 'GreenCheap\\Seo\\Sitemaps\\NodeSitemap'
        ],
        'blog' => [
            'name' => 'blog',
            'generator' => 'GreenCheap\\Seo\\Sitemaps\\BlogSitemap'
        ]
    ],

    'events' => [
        'view.meta' => [function ($event, $meta) use ($app) {
            if ($meta->get('og:title')) {
                $title[] = $app->config('system/site')->get('title');
                $title[] = $meta->get('og:title');

                if ($app->request()->getPathInfo() === '/') {
                    $title = array_reverse($title);
                }

                $meta->add('title', implode(' | ', $title));
            } else {
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
    ]
];
