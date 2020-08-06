<?php

return [
    'name' => 'seo',

    'menu' => [
        'seo' => [
            'label' => 'SEO',
            'icon' => 'seo:icon.svg',
            'url' => '',
            'active' => '',
            'priority' => 300
        ]
    ],

    'events' => [
        'view.system/site/admin/edit' => function($event, $view){
            $view->script('seo-node-meta', 'seo:app/bundle/modules/node-meta.js', 'site-edit');
        }
    ],
];
