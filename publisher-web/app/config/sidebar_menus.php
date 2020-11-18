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
        'text' => 'MANAGER USER'
    ],
    'bc' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'User managers',
        'children' => [
            'user_list' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'List user',
                'href' => '/user'
            ],
            'user_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Create user',
                'href' => '/user/create'
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
                'text' => 'List bill',
                'href' => '/bill'
            ],
            'issuer_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Create bill',
                'href' => '/bill/create'
            ],

        ],
        'role' => 'ADMIN'
    ],

    'bill' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Bill managers',
        'children' => [
            'bill_list' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'List bill',
                'href' => '/bill'
            ],
            'bill_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Create bill',
                'href' => '/bill/create'
            ],
        ]
    ],
    'product' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Product managers',
        'children' => [
            'product' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'List product',
                'href' => '/product'
            ],
            'product_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Create product',
                'href' => '/product/create'
            ],
        ]
    ],



]);