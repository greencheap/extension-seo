<?php

namespace GreenCheap\Seo\Sitemaps;

use GreenCheap\Application as App;
use GreenCheap\Seo\SitemapInterface;
use GreenCheap\System\Model\StatusModelTrait;
use GreenCheap\Docs\Model\Category;

/**
 * Class BlogSitemap
 * @package GreenCheap\Seo\Sitemaps
 */
class DocsSitemap implements SitemapInterface
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

        $categories = Category::where(["status = :status"], ["status" => StatusModelTrait::getStatus("STATUS_PUBLISHED")])
            ->where(function ($query) {
                return $query->where("roles IS NULL")->whereInSet("roles", App::user()->roles, false, "OR");
            })
            ->orderBy("priority", "asc")
            ->related("posts")
            ->get();

        foreach ($categories as $category) {
            foreach ($category->getPosts() as $post) {
                $data[] = [
                    "url" => [
                        "loc" => App::url("@docs/id", ["id" => $post->id ?: 0], 0),
                        "lastmod" => $post->modified->format("Y-m-d"),
                    ],
                ];
            }
        }

        return $data;
    }
}
