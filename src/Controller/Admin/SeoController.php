<?php 
namespace GreenCheap\SEO\Controller\Admin;

use GreenCheap\Application as App;

/**
 * @Route(name="admin") 
 * @Access(admin=true)
 */
class SeoController
{  
    /**
    * @Access("seo: module management access || seo: redirect management")
    * @Route("/redirect")
    * @Request({"filter":"array","page":"integer"})
    */
    public function redirectAction( array $filter = [] , int $page = null )
    {
        return 'Hello World';
    }
}
?>