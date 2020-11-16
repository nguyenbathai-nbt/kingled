<?php
return new \Phalcon\Config([
//    'headerdb' => [
//        'cssClass' => 'header',
//        'text' => 'DASHBROAD'
//    ],
//    'db' => [
//        'active' => true,
//        'iconCss' => 'fa fa-dashboard',
//        'text' => 'Dashboard',
//        'href' => '/admin '
//    ],
    'headerbadgechain' => [
        'cssClass' => 'header',
        'text' => 'MANAGER GROUP'
    ],
    'bc' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Group managers',
        'children' => [
            'group_list' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'List group',
                'href' => '/group'
            ],
            'group_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Create group',
                'href' => '/group/create'
            ],
        ]
    ],
    'headerissued' => [
        'cssClass' => 'header',
        'text' => 'MANAGER ISSUED',
        'role'=>'ADMIN'
    ],
    'is' => [
        'active' => true,
        'iconCss' => 'fa fa-users',
        'text' => 'Issued managers',
        'children' => [
            'issuer_list' => [
                'iconCss' => 'fa fa-clone   ',
                'text' => 'List issuer',
                'href' => '/issuer'
            ],
            'issuer_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Create issuer',
                'href' => '/issuer/create'
            ],

        ],
        'role' => 'ADMIN'
    ],
    'headermyapikey' => [
        'cssClass' => 'header',
        'text' => 'MY API KEY'
    ],
    'ak' => [
        'active' => true,
        'iconCss' => 'fa fa-key',
        'text' => 'Api key',
        'href' => '/issuer/apiKey'
    ],
    'ws' => [
        'active' => true,
        'iconCss' => 'fa fa-key',
        'text' => 'Web Subscriber',
        'href' => '/issuer/webSubscriber'
    ],


]);