<?php
namespace GreenCheap\SEO\Controller;

use GreenCheap\Application as App;

/**
 * @Access(admin=true)
 */
class ApiSitemapController
{

    /**
     * @Request(csrf=true)
     */
    public function getConfigAction()
    {
        $data = [];
        $robots_txt = App::get('path').'/robots.txt'; 
        if( App::file()->exists($robots_txt) ){
            $my_file = fopen($robots_txt , "r");
            $data['robots_txt'] = fread($my_file , filesize($robots_txt));
            fclose($my_file);
        }
        return $data;
    }

    /**
     * @Route(methods="GET")
     * @Request({"robots_txt":"string","config":"array"} , csrf=true)
     */
    public function saveConfigAction( string $robots_txt = '' , array $config = [])
    {
        if( $robots_txt && App::file()->exists(App::get('path').'/robots.txt') ){
            echo'Var';
            $my_file = fopen(App::get('path').'/robots.txt' , "w");
            fwrite($my_file, $robots_txt);
            fclose($my_file);
        }

        $module_config = App::config()->set('seo', $config);
        return [
            'message' => 'Success'
        ];
    }
}
?>