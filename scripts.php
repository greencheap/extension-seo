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
        },

        '1.0.6' => function($app){
            $util = $app['db']->getUtility();

            if(!$util->tableExists('@seo_redirect')){
                $util->createTable('@seo_redirect' , function($table){
                    $table->addColumn('id' , 'integer' , ['autoincrement' => true , 'unsigned' => true , 'length' => 10]);
                    $table->addColumn('source_link' , 'string');
                    $table->addColumn('target_link' , 'string');
                    $table->addColumn('redirect_type' , 'integer');
                    $table->addColumn('redirect_count' , 'integer' , ['default' => 0]);
                    $table->addColumn('date' , 'datetime');
                    $table->setPrimaryKey(['id']);
                    $table->addIndex(['source_link'] , 'SEO_REDIRECT_SOURCE_LINK');
                });
            }
        }
    ]
];
