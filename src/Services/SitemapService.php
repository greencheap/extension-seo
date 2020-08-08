<?php
namespace GreenCheap\SEO\Services;

use GreenCheap\Application;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SitemapService
 * @package GreenCheap\SEO\Services
 */
class SitemapService
{
    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var Array
     */
    protected $items = [];

    /**
     * SitemapService constructor.
     */
    public function __construct()
    {
        $this->response = new Response;
        $this->loadConfigure();
        return $this;
    }


    public function addItem( string $url, $date, array $options = [] )
    {
        $items = [
            [
                'tag' => 'loc',
                'value' => $url
            ],
            [
                'tag' => 'lastmod',
            ]
        ];

        if(is_object($date)){
            $items['1']['value'] = $date->format('Y-m-d');
        }else{
            $items['1']['value'] = $date;
        }

        if($options){
            $items = array_merge($items , $options);
        }

        array_push($this->items , $items);
        return $this;
    }

    /**
     * @return void
     */
    protected function loadConfigure()
    {
        $this->response->headers->set('Content-Type', 'xml');
    }

    /**
     * @return Response
     */
    public function render()
    {

        return $this->response->setContent(Application::view('seo:views/sitemap.php' , [
            'items' => $this->items,
            'depth' => 0
        ]));
    }
}
