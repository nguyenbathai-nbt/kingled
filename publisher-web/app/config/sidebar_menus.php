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
        'text' => 'Quản lý lệnh sản xuất',
        'children' => [
            'bill_list' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Danh sách lệnh sản xuất',
                'href' => '/bill'
            ],
            'bill_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Tạo mới lệnh sản xuất',
                'href' => '/bill/create'
            ],
            'bill_create_import' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Nhập lệnh sản xuất',
                'href' => '/bill/importbill'
            ],
        ]
    ],
    'product' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Quản lý sản phẩm',
        'children' => [
            'product_list' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Danh sách sản phẩm',
                'href' => '/product'
            ],
            'product_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Tạo mới sản phẩm',
                'href' => '/product/create'
            ],
            'product_create_excel' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Tạo mới lô sản phẩm',
                'href' => '/product/importproduct'
            ],
        ]
    ],
    'producer' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Quản lý chuyền',
        'children' => [
            'product' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Danh sách chuyền',
                'href' => '/producer'
            ],
            'product_create' => [
                'iconCss' => 'fa fa-folder-o',
                'text' => 'Tạo mới chuyền',
                'href' => '/producer/create'
            ],
        ]
    ],
    'exports' => [
        'active' => true,
        'iconCss' => 'fa fa-id-badge',
        'text' => 'Quản lý báo cáo',
        'children' => [
            'export' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Xuất báo cáo',
                'href' => '/report'
            ],
            'export_month' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Xuất bc theo tháng',
                'href' => '/report/reportViaMonth'
            ],
            'export_product' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Xuất bc theo sản phẩm',
                'href' => '/report/reportViaProduct'
            ],
            'export_product_month' => [
                'iconCss' => 'fa fa-clone',
                'text' => 'Xuất bc theo sản phẩm và tháng',
                'href' => '/report/reportViaProductAndMonth'
            ],


        ]
    ],



]);