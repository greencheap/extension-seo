<?php
namespace GreenCheap\Seo\Sitemaps;

use GreenCheap\Seo\SitemapInterface;

/**
 * Class NodeSitemap
 * @package GreenCheap\Seo\Sitemaps
 */
class NodeSitemap implements SitemapInterface
{
    /**
     * @return array
     */
    public function getData(): array
    {
        $data = [];

        $data[] = [
            'url' => [
                'loc' => 'Hello World'
            ]
        ];

        return $data;
    }
}