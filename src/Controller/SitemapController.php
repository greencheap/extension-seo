<?php
namespace GreenCheap\SEO\Controller;

use GreenCheap\SEO\Services\SitemapService;
use GreenCheap\Site\Model\Node;
use GreenCheap\Application as App;
/**
 * @Route("/sitemap" , name="sitemap")
 */
class SitemapController
{
    /**
     * @var \DateTime
     */
    protected \DateTime $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @Route("/node" , format="xml")
     * @Route("/node.{_format}" , format="xml" , requirements={"_format": "xml"})
     */
    public function nodeAction()
    {
        $sitemap_service = new SitemapService();

        $nodes = Node::where(['status = ?' , 'type != ?'], [1 , 'external'])->where(function ($query) {
            return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
        })->get();

        foreach ($nodes as $node){
            $sitemap_service->addItem(App::url()->base(0).$node->getUrl(true) , $this->date->format('Y'));
        }

        return $sitemap_service->render();
    }

    /**
     * @Route("/docs" , format="xml")
     * @Route("/docs.{_format}" , format="xml" , requirements={"_format": "xml"})
     */
    public function docsAction()
    {
        
    }
}
?>
