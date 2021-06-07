<?php
namespace GreenCheap\Seo\Controller;

use GreenCheap\Application as App;
use GreenCheap\Seo\Sitemaps;
use Sabre\Xml\Service as SabreService;
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

        $xmlService = new SabreService();

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
     * @Route("/{sitemap}/page_{page}.xml", format="xml", name="page")
     * @param string $sitemap
     * @param int $page
     * @return mixed
     */
    public function sitemapAction(string $sitemap, int $page = 0, ): mixed
    {
        $module = (object) $this->get($sitemap);
        if(!$module){
            return App::abort(404, 'Not Found Sitemap');
        }

        $generator = $module->generator;

        $response = new Response();
        $response->headers->set('content-type', 'application/xml');

        $xmlService = new SabreService();

        if(!class_exists($generator)){
            return App::abort(404, 'Not Found Class');
        }

        $data = new $generator;
        $write = $xmlService->write('urlset', $data->getData($page));

        $response->setContent($write);
        return $response;
    }
}
