<?php
return [
    [
        'slug' => 'manage-dashboard',
        'key' => 'manage-dashboard',
        'name' => "Quản lý câu hỏi",
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
                        'name' => "Xem",
                        'children' => [
                            [
                                'slug' => 'question_aswer_service_detail_list',
                                'key' => 'question_aswer_service_detail_list',
                                'name' => "Xem Danh sách",
                            ]
                        ]
                    ],
                    [
                        'slug' => 'question_aswer_service_detail',
                        'key' => 'question_aswer_service_detail',
                        'name' => "Xem",
                        'children' => [
                            [
                                'slug' => 'question_aswer_service_detail',
                                'key' => 'question_aswer_service_detail',
                                'name' => "Xem chi tiết",
                            ]
                        ]
                    ],
                    [
                        'slug' => 'question_aswer_service_edit',
                        'key' => 'question_aswer_service_edit',
                        'name' => "Cập nhật",
                        'children' => [
                            [
                                'slug' => 'question_aswer_service_edit',
                                'key' => 'question_aswer_service_edit',
                                'name' => "Cập nhật",
                            ],
                        ]
                    ],
                    [
                        'slug' => 'question_aswer_service_create',
                        'key' => 'question_aswer_service_create',
                        'name' => "Tạo mới",
                        'children' => [
                            [
                                'slug' => 'question_aswer_service_create',
                                'key' => 'question_aswer_service_create',
                                'name' => "Tạo mới ",
                            ],
                        ]
                    ],
                    [
                        'slug' => 'question_aswer_service_delete',
                        'key' => 'question_aswer_service_delete',
                        'name' => "Xóa",
                        'children' => [
                            [
                                'slug' => 'question_aswer_service_delete',
                                'key' => 'question_aswer_service_delete',
                                'name' => "Xóa",
                            ],
                        ]
                    ],
                ]
            ]
        ]
    ]
];
