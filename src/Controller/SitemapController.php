<?php
namespace GreenCheap\SEO\Controller;

use GreenCheap\SEO\Services\SitemapService;
use GreenCheap\Site\Model\Node;
use GreenCheap\Application as App;
use GreenCheap\System\Model\StatusModelTrait;
/**
 * @Route("/sitemap" , name="sitemap")
 */
class SitemapController
{
    /**
     * @var \DateTime
     */
    protected \DateTime $date;

    /**
     * SitemapController Construct
     */
    public function __construct()
    {
        $this->date = new \DateTime;
    }

    /**
     * @Route("/node.{_format}", format="xml" , requirements={"_format": "xml"})
     */
    public function nodeAction()
    {
        $sitemap_service = new SitemapService();

        $nodes = Node::where(['status = :status' , 'type != :type'], ['status' => 1 , 'type' => 'external'])->where(function ($query) {
            return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
        })->get();

        foreach ($nodes as $node){
            $sitemap_service->addItem(App::url()->base(0).$node->getUrl(true) , $this->date->format('Y-m'));
        }

        return $sitemap_service->render();
    }

    /**
     * @Route("/docs.{_format}", format="xml" , requirements={"_format": "xml"})
     */
    public function docsAction()
    {
        if( !$module = App::module('docs') ){
            return App::abort(404 , __('Not Found Extension %ex%' , ['%ex%' => 'Docs']));
        }

        $sitemap_service = new SitemapService();
        $categories = \GreenCheap\Docs\Model\Category::where(['status = :status'], ['status' => StatusModelTrait::getStatus('STATUS_PUBLISHED')])->where(function ($query) {
            return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
        })->orderBy('priority' , 'asc')->related('posts')->get();

        foreach($categories as $category){
            foreach($category->getPosts() as $post){
                $sitemap_service->addItem(App::url('@docs/id', ['id' => $post->id ?: 0], 0) , $post->modified->format('Y-m-d'));
            }
        }
        return $sitemap_service->render();
    }

    /**
     * @Route("/blog.{_format}", format="xml" , requirements={"_format": "xml"})
     * @Route("/blog/{page}.xml", format="xml" , name="blog/page" , requirements={"page":"\d+","_format": "xml"}) 
     */
    public function blogAction(int $page = null){
        if( !$module = App::module('blog') ){
            return App::abort(404 , __('Not Found Extension %ex%' , ['%ex%' => 'Blog']));
        }

        $sitemap_service = new SitemapService();

        if(!$page){
            $query = \GreenCheap\Blog\Model\Post::query()->where(['status = :status', 'date < :date'], ['status' => \GreenCheap\Blog\Model\Post::getStatus('STATUS_PUBLISHED'), 'date' => new \DateTime])->where(function ($query) {
                return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
            });
            
            if (!$limit = $module->config('sitemap/sitemap_per_page')) {
                $limit = 50;
            }
            
            $count = $query->count('id');
            $total = ceil($count / $limit);
            for($i = 1; $i <= $total; $i++){
                $sitemap_service->addItem(App::url('@seo/sitemap/blog/page' , ['page' => $i] , 0), $this->date->format('Y-m'));
            }
        }else if($page && $page > 0){
            $query = \GreenCheap\Blog\Model\Post::query()->where(['status = :status', 'date < :date'], ['status' => \GreenCheap\Blog\Model\Post::getStatus('STATUS_PUBLISHED'), 'date' => new \DateTime])->where(function ($query) {
                return $query->where('roles IS NULL')->whereInSet('roles', App::user()->roles, false, 'OR');
            });
    
            if (!$limit = $module->config('sitemap/sitemap_per_page')) {
                $limit = 50;
            }
            
            $count = $query->count('id');
            $total = ceil($count / $limit);
            $page = max(1, min($total, $page));
            

            $query->offset(($page - 1) * $limit)->limit($limit)->orderBy('date', 'DESC');
            foreach ($query->get() as $post) {
                $sitemap_service->addItem(App::url('@blog/id' , ['id' => $post->id] , 0), $post->modified->format('Y-m-d'));
            }
        }else{
            return App::abort(500 , __('Something is wrong.'));
        }

        return $sitemap_service->render();
    }
    
}
?>
