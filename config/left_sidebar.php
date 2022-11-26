<?php
return [
    [
        'router' => '',
        'name' => 'QL Tài khoản',
        'icon' => 'nav-icon fas fa-users',
        'active' => true,
        'hasActivePage' => [
            'users.list', 'roles.list', 'groups.list'
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
        'name' => 'QL Dịch vụ - Câu hỏi',
        'icon' => 'nav-icon fas fa-address-book',
        'active' => true,
        'hasActivePage' => [
            'list-blog-categories', 'question.list'
        ],
        'position' => 0,
        'authorize' => [],
        'children' => [
            [
                'router' => 'services.list',
                'name' => 'Danh sách dịch vụ',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'list-blog-categories'
                ],
                'position' => 1,
                'authorize' => [],
                'active' => true
            ],
            [
                'router' => 'questions.list',
                'name' => 'Danh sách câu hỏi',
                'icon' => 'far fa-circle nav-icon',
                'hasActivePage' => [
                    'question.list'
                ],
                'position' => 1,
                'authorize' => [],
                'active' => true
            ],
        ]
    ],
];
