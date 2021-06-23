<?php

namespace GreenCheap\Seo\Sitemaps;

use GreenCheap\Application as App;
use GreenCheap\Seo\SitemapInterface;
use GreenCheap\Site\Model\Node;

/**
 * Class NodeSitemap
 * @package GreenCheap\Seo\Sitemaps
 */
class NodeSitemap implements SitemapInterface
{
    /**
     * @var \DateTime
     */
    protected \DateTime $date;

    /**
     * NodeSitemap constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @param int $page
     * @return array
     */
    public function getData($page = 0): array
    {
        $data = [];

        foreach ($this->getNodes() as $node) {
            $data[] = [
                "url" => [
                    "loc" => App::url()->base(0) . $node->getUrl(true),
                    "lastmod" => $this->date->format("Y-m-d"),
                ],
            ];
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getNodes(): array
    {
        return Node::where(["status = :status", "type != :type"], ["status" => 1, "type" => "external"])
            ->where(function ($query) {
                return $query->where("roles IS NULL")->whereInSet("roles", App::user()->roles, false, "OR");
            })
            ->get();
    }
}
