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
        'iconCss' => 'fa fa-users',
        'text' => 'Group managers',
        'children' => [
            'group_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'List group',
                'href' => '/group'
            ],
            'group_create' => [
                'iconCss' => 'fa fa-users',
                'text' => 'Create group',
                'href' => '/group/create'
            ],
        ]
    ],
    'headerissued' => [
        'cssClass' => 'header',
        'text' => 'MANAGER ISSUED'
    ],
    'is' => [
        'active' => true,
        'iconCss' => 'fa fa-users',
        'text' => 'Issued managers',
        'children' => [
            'issued_list' => [
                'iconCss' => 'fa fa-users',
                'text' => 'List issued',
                'href' => '/issued'
            ]

        ]
    ]



]);