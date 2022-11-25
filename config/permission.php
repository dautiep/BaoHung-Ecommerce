<?php
return [
    [
        'slug' => 'manage-dashboard',
        'key' => 'manage-dashboard',
        'name' => "Quản Full Quyền",
        'group' => false,
        'required' => true,
        'position' => 11,
        'children' => [
            [
                'slug' => 'question_aswer_service-manage',
                'key' => 'question_aswer_service-manage',
                'name' => "Quản lý câu hỏi ",
                'group' => true,
                'required' => true,
                'children' => [
                    [
                        'slug' => 'question_aswer_service_list',
                        'key' => 'question_aswer_service_list',
                        'name' => "Xem danh sách",
                        'children' => []
                    ],

                    [
                        'slug' => 'question_aswer_service_edit',
                        'key' => 'question_aswer_service_edit',
                        'name' => "Chỉnh sửa",
                        'children' => []
                    ],
                    [
                        'slug' => 'question_aswer_service_create',
                        'key' => 'question_aswer_service_create',
                        'name' => "Thêm mới",
                        'children' => []
                    ],
                    [
                        'slug' => 'question_aswer_service_delete',
                        'key' => 'question_aswer_service_delete',
                        'name' => "Xóa",
                        'children' => []
                    ],
                ]
            ],
            [
                'slug' => 'users',
                'key' => 'users',
                'name' => "Quản lý tài khoản ",
                'group' => true,
                'required' => true,
                'children' => [
                    [
                        'slug' => 'users.list',
                        'key' => 'users.list',
                        'name' => "Xem danh sách",
                        'children' => []
                    ],

                    [
                        'slug' => 'users.edit',
                        'key' => 'users.edit',
                        'name' => "Chỉnh sửa",
                        'children' => []
                    ],
                    [
                        'slug' => 'users.create',
                        'key' => 'users.create',
                        'name' => "Thêm mới",
                        'children' => []
                    ],
                    [
                        'slug' => 'users.delete',
                        'key' => 'users.delete',
                        'name' => "Xóa",
                        'children' => []
                    ],
                ]
            ]
        ]
    ]
];
