<?php
return [
    [
        'router' => '',
        'name' => 'QL Tài khoản',
        'icon' => 'nav-icon fas fa-users',
        'active' => true,
        'hasActivePage' => [
            'users.list', 'roles.list', 'groups.list', 'department.list'
        ],
        'position' => 0,
        'authorize' => ['super-admin'],
        'children' => [
            [
                'router' => 'users.list',
                'name' => 'Danh sách tài khoản',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'users.list'
                ],
                'position' => 1,
                'authorize' => ['users.list'],
                'active' => true
            ],
            [
                'router' => 'department.list',
                'name' => 'Danh sách phòng ban',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'department.list'
                ],
                'position' => 1,
                'authorize' => ['department.list'],
                'active' => true
            ],
            [
                'router' => 'groups.list',
                'name' => 'Danh sách nhóm quyền',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'groups.list'
                ],
                'position' => 1,
                'authorize' => [],
                'active' => true
            ],
            [
                'router' => 'roles.list',
                'name' => 'Danh sách bộ quyền',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'roles.list'
                ],
                'position' => 1,
                'authorize' => [],
                'active' => true
            ],
        ]
    ],
    [
        'router' => '',
        'name' => 'Dịch vụ - Sản phẩm',
        'icon' => 'nav-icon fas fa-address-book',
        'active' => true,
        'hasActivePage' => [
            'list-services', 'list-categories', 'other_faqs.list'
        ],
        'position' => 0,
        'authorize' => [],
        'children' => [
            [
                'router' => 'services.list',
                'name' => 'QL dịch vụ',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'list-services'
                ],
                'position' => 1,
                'authorize' => ['services.list'],
                'active' => true
            ],
            [
                'router' => 'categories.list',
                'name' => 'QL danh mục',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'list-categories'
                ],
                'position' => 1,
                'authorize' => [],
                'active' => true
            ],
            [
                'router' => 'other_faqs.list',
                'name' => 'QL sản phẩm',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'other_faqs.list'
                ],
                'position' => 1,
                'authorize' => [],
                'active' => true
            ]
        ]
    ],
    [
        'router' => '',
        'name' => 'QL Cache hệ thống',
        'icon' => 'nav-icon fas fa-address-book',
        'active' => true,
        'hasActivePage' => [],
        'position' => 0,
        'authorize' => ['config_cache'],
        'children' => [
            [
                'router' => 'config_cache.artisanCache',
                'name' => 'Cập nhật cache hệ thống',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [],
                'position' => 1,
                'authorize' => ['config_cache.artisanCache'],
                'active' => true
            ]
        ]
    ]
];
