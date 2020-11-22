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

    'bc' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Quản lý người dùng',
        'children' => [
            'user_list' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Danh sách người dùng',
                'href' => '/user'
            ],
            'user_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Tạo mới tài khoản',
                'href' => '/user/create'
            ],
        ]
    ],
    'bill' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Quản lý hóa đơn',
        'children' => [
            'bill_list' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Danh sách hóa đơn',
                'href' => '/bill'
            ],
            'bill_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Tạo mới hóa đơn',
                'href' => '/bill/create'
            ],
        ]
    ],
    'product' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Quản lý sản phẩm',
        'children' => [
            'product' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Danh sách sản phẩm',
                'href' => '/product'
            ],
            'product_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Tạo mới sản phẩm',
                'href' => '/product/create'
            ],
        ]
    ],



]);