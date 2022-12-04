<?php
return [
    [
        'slug' => 'manage-dashboard',
        'key' => 'manage-dashboard',
        'name' => "Quản lý Full Quyền",
        'group' => false,
        'required' => true,
        'position' => 11,
        'children' => [
            [
                'slug' => 'questions',
                'key' => 'questions',
                'name' => "Quản lý câu hỏi ",
                'group' => true,
                'required' => true,
                'children' => [
                    [
                        'slug' => 'questions.list',
                        'key' => 'questions.list',
                        'name' => "Xem danh sách",
                        'children' => []
                    ],

                    [
                        'slug' => 'questions.listRole',
                        'key' => 'questions.listRole',
                        'name' => "Xem danh sách theo quyền",
                        'children' => [
                            [
                                'slug' => 'questions.listStaff',
                                'key' => 'questions.listStaff',
                                'name' => "Xem danh sách theo quyền nhân viên",
                                'children' => []
                            ],
                            [
                                'slug' => 'questions.listBoss',
                                'key' => 'questions.listBoss',
                                'name' => "Xem danh sách theo quyền lãnh đạo phòng",
                                'children' => []
                            ]
                        ]
                    ],

                    [
                        'slug' => 'questions.edit',
                        'key' => 'questions.edit',
                        'name' => "Chỉnh sửa",
                        'children' => []
                    ],
                    [
                        'slug' => 'questions.create',
                        'key' => 'questions.create',
                        'name' => "Thêm mới",
                        'children' => []
                    ],
                    [
                        'slug' => 'questions.lock',
                        'key' => 'questions.lock',
                        'name' => "Khóa",
                        'children' => []
                    ],
                    [
                        'slug' => 'questions.approved',
                        'key' => 'questions.approved',
                        'name' => "Phê duyệt",
                        'children' => []
                    ],
                ]
            ],
            [
                'slug' => 'services',
                'key' => 'services',
                'name' => "Quản lý dịch vụ",
                'group' => true,
                'required' => true,
                'children' => [
                    [
                        'slug' => 'services.create',
                        'key' => 'services.create',
                        'name' => "Thêm mới",
                        'children' => []
                    ],
                    [
                        'slug' => 'services.list',
                        'key' => 'services.list',
                        'name' => "Xem danh sách",
                        'children' => []
                    ],
                    [
                        'slug' => 'services.edit',
                        'key' => 'services.edit',
                        'name' => "Chỉnh sửa",
                        'children' => []
                    ],
                    [
                        'slug' => 'services.lock',
                        'key' => 'services.lock',
                        'name' => "Khóa",
                        'children' => []
                    ],
                    [
                        'slug' => 'services.unlock',
                        'key' => 'services.unlock',
                        'name' => "Khóa",
                        'children' => []
                    ],
                ]
            ],
            [
                'slug' => 'faq',
                'key' => 'faq',
                'name' => "Quản lý câu hỏi tư vấn",
                'group' => true,
                'required' => true,
                'children' => [
                    [
                        'slug' => 'faq.approved',
                        'key' => 'faq.approved',
                        'name' => "Phê duyệt",
                        'children' => []
                    ],
                    [
                        'slug' => 'faq.list',
                        'key' => 'faq.list',
                        'name' => "Xem danh sách",
                        'children' => []
                    ],
                    [
                        'slug' => 'faq.listRole',
                        'key' => 'faq.listRole',
                        'name' => "Xem danh sách theo quyền",
                        'children' => [
                            [
                                'slug' => 'faq.listStaff',
                                'key' => 'faq.listStaff',
                                'name' => "Xem danh sách theo quyền nhân viên",
                                'children' => []
                            ],
                            [
                                'slug' => 'faq.listBoss',
                                'key' => 'faq.listBoss',
                                'name' => "Xem danh sách theo quyền lãnh đạo phòng",
                                'children' => []
                            ]
                        ]
                    ],
                    [
                        'slug' => 'faq.edit',
                        'key' => 'faq.edit',
                        'name' => "Chỉnh sửa",
                        'children' => []
                    ],
                    [
                        'slug' => 'faq.sendmail',
                        'key' => 'faq.sendmail',
                        'name' => "Gửi mail",
                        'children' => []
                    ],
                    [
                        'slug' => 'faq.lock',
                        'key' => 'faq.lock',
                        'name' => "Khóa",
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
