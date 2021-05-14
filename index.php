<?php
return [
    "name" => "seo",

    "main" => function($app){

    },

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
        ]
    ]
];
