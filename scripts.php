<?php 
use GreenCheap\Application as App;
return [
    'install' => function($app)
    {
        $util = $app['db']->getUtility();
    },

    'uninstall' => function($app)
    {
        $util = $app['db']->getUtility();
    },

    'enable' => function($app)
    {
        $path = App::get('path');
        if(!$app['file']->exists("$path/robots.txt")){
            $app['file']->copy("$path/packages/greencheap/seo/.robots" , "$path/robots.txt");
        }
    },

    'update' => [
        '1.0.4' => function($app){
            $path = App::get('path');
            if(!$app['file']->exists("$path/robots.txt")){
                $app['file']->copy("$path/packages/greencheap/seo/.robots" , "$path/robots.txt");
            }
        }
    ]
];
