<?php
return new \Phalcon\Config([
    'headerbadgechain' => [
        'cssClass' => 'header',
        'text' => 'QUẢN LÝ NGƯỜI DÙNG',
        'role'=>['ADMIN']
    ],
    'user' => [
        'active' => true,
        'iconCss' => 'fa fa-users',
        'text' => 'Quản lý người dùng',
        'children' => [
            'user_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Danh sách người dùng',
                'href' => '/admin/user/listUser'
            ],
            'role_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Danh sách quyền',
                'href' => '/admin/role/listRole'
            ],
            'status_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Danh sách trạng thái',
                'href' => '/admin/status/listStatus'
            ],
            'user_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Tạo người dùng',
                'href' => '/admin/user/createUser'
            ],

            'role_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Tạo quyền',
                'href' => '/admin/role/createRole'
            ],

            'status_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Tạo trạng thái',
                'href' => ' /admin/status/createStatus'
            ]
        ],
        'role'=>['ADMIN']
    ],
    'headerissued' => [
        'cssClass' => 'header',
        'text' => 'QUẢN LÝ CÔNG THỨC',
        'role'=>['ADMIN','CHEF']
    ],
    'recipe' => [
        'active' => true,
        'iconCss' => 'fa fa-users',
        'text' => 'Quản lý công thức',
        'children' => [
            'recipe_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Danh sách công thức',
                'href' => '/admin/recipe-cook/listRecipeCook'
            ],
            'quantitative_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Danh sách định lượng',
                'href' => '/admin/quantitative/listQuantitative'
            ],
            'quantitative_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Tạo định lượng',
                'href' => '/admin/quantitative/createQuantitative'
            ],
            'raw_material_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Danh sách nguyên liệu',
                'href' => '/admin/raw-material/listRawMaterial'
            ],
            'raw_material_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Tạo nguyên liệu',
                'href' => '/admin/raw-material/createRawMaterial'
            ],
        ],
        'role'=>['ADMIN','CHEF']
    ],
    'headerbookmark' => [
        'cssClass' => 'header',
        'text' => 'QUẢN LÝ ĐÁNH DẤU',
        'role'=>['ADMIN']
    ],
    'bookmark' => [
        'active' => true,
        'iconCss' => 'fa fa-users',
        'text' => 'Quản lý đánh dấu',
        'children' => [
            'category_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Danh sách nhóm công thức',
                'href' => '/admin/category/listCategory'
            ],
            'category_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Tạo nhóm công thức',
                'href' => '/admin/category/createCategory'
            ],
        ],
        'role'=>['ADMIN']
    ],
]);