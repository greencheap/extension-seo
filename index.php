<?php

use GreenCheap\View\Event\ViewEvent;

return [
    "name" => "seo",

    "autoload" => [
        "GreenCheap\\Seo\\" => "src",
    ],

    "nodes" => [
        "sitemap" => [
            "name" => "@sitemap",
            "label" => "Sitemap",
            "controller" => "GreenCheap\\Seo\\Controller\\SitemapController",
            "protected" => true,
            "frontpage" => true,
        ],
    ],

    "sitemaps" => [
        "node" => [
            "name" => "node",
            "generator" => "GreenCheap\\Seo\\Sitemaps\\NodeSitemap",
        ],
    ],

    "events" => [
        "view.system/site/admin/edit" => function ($event, $view) {
            $view->script("node-seo", "seo:app/bundle/node-meta.js", ["site-edit", "multi-finder"]);
        },

        "view.meta" => [
            function ($event, $meta) use ($app) {
                if ($app->isAdmin()) {
                    return;
                }

                if ($meta->get("og:title")) {
                    $title[] = $app->config("system/site")->get("title");
                    $title[] = $meta->get("og:title");
                } else {

                    if ($meta->get("title")) {
                        $title[] = $meta->get("title");
                    }

                    $title[] = $app->config("system/site")->get("title");
                }
                $title = array_reverse($title);
                $meta->add("title", implode(" | ", $title));
            },
            -51,
        ],

        "view.scripts" => function ($event, $scripts) {
            $scripts->register('blog-meta', 'seo:app/bundle/blog-meta.js', '~post-edit');
            $scripts->register('blog-category-meta', 'seo:app/bundle/blog-category-meta.js', ['~categories-edit', 'multi-finder']);
        }
    ],
];
