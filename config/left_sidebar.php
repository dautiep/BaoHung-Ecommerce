<?php
return [
    [
        'router' => '',
        'name' => 'QL câu hỏi - Dịch vụ',
        'icon' => 'nav-icon fas fa-address-book',
        'active' => true,
        'hasActivePage' => [
            'list-blog-categories',
        ],
        'position' => 0,
        'authorize' => [],
        'children' => [
            [
                'router' => '',
                'name' => 'Danh sách dịch vụ',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'list-blog-categories'
                ],
                'position' => 1,
                'authorize' => [],
                'active' => true
            ],
        ]
    ],
    [
        'router' => '',
        'name' => 'QL Tài khoản',
        'icon' => 'nav-icon fas fa-address-book',
        'active' => true,
        'hasActivePage' => [
            'users.list'
        ],
        'position' => 0,
        'authorize' => [],
        'children' => [
            [
                'router' => 'users.list',
                'name' => 'Danh sách tài khoản',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'users.list'
                ],
                'position' => 1,
                'authorize' => [],
                'active' => true
            ],
        ]
    ]
];
