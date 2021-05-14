<?php
namespace GreenCheap\Seo\Controller;

use GreenCheap\Application as App;
use GreenCheap\Seo\Sitemaps;
use Sabre\Xml\Service;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SitemapController
 * @package GreenCheap\Seo\Controller
 */
class SitemapController extends Sitemaps
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $response = new Response();
        $response->headers->set('content-type', 'application/xml');

        $xmlService = new Service();

        $data = [];

        foreach($this->getAll() as $key => $module){
            $data[] = [
                'url' => [
                    'loc' => App::url('@sitemap/sitemap', ['sitemap' => $key], 0)
                ]
            ];
        }

        $write = $xmlService->write('urlset', $data);

        $response->setContent($write);
        return $response;
    }

    /**
     * @Route("/{sitemap}.xml", format="xml", name="sitemap")
     * @param $sitemap
     * @return Response
     */
    public function sitemapAction($sitemap): Response
    {
        $module = (object) $this->get($sitemap);
        if(!$module){
            return App::abort(404, 'Not Found Sitemap');
        }

        $generator = $module->generator;

        $response = new Response();
        $response->headers->set('content-type', 'application/xml');

        $xmlService = new Service();

        if(!class_exists($generator)){
            return App::abort(404, 'Not Found Class');
        }

        $data = new $generator;
        $write = $xmlService->write('urlset', $data->getData());

        $response->setContent($write);
        return $response;
    }
}