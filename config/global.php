<?php
return [
    'default' => [
        'status' => [
            'unanswered' => [
                'key' => 0,
                'name' => 'Chưa giải đáp',
            ],
            'answered' => [
                'key' => 1,
                'name' => 'Đã giải đáp',
            ],
            'refuses_answer' => [
                'key' => 2,
                'name' => 'Bị block'
            ],
            'users' => [
                [
                    'key' => 1,
                    'name' => 'Hoạt động'
                ],
                [
                    'key' => 0,
                    'name' => 'Khóa tài khoản'
                ]
            ],
            'type_of_services' => [
                [
                    'key' => 1,
                    'name' => 'Đang chạy',
                    'action' => 'Khóa dịch vụ'
                ],
                [
                    'key' => 0,
                    'name' => 'Đã khóa',
                    'action' => 'Mở khóa dịch vụ'
                ]
            ],
            'groups' => [
                [
                    'key' => 1,
                    'name' => 'Hoạt động'
                ],
                [
                    'key' => 0,
                    'name' => 'Khóa'
                ]
            ]

        ],
        'messages' => [
            'users' => [
                'create' => 'Thêm tài khoản thành công',
                'edit' => 'Chỉnh sửa tài khoản thành công',
            ],
            'type_of_services' => [
                'store' => 'Lưu thông tin dịch vụ thành công',
                'error' => 'Đã xảy ra lỗi!',
                'create' => 'Thêm tài khoản thành công',
                'lock' => 'Đã khóa dịch vụ',
                'unlock' => 'Đã mở khóa dịch vụ',
                'edit'   => 'Chỉnh sửa dịch vụ thành công',
            ],
            'roles' => [
                'create' => 'Thêm bộ quyền thành công',
                'edit' => 'Cập nhật quyền thành công',
                'delete'   => 'Xóa quyền thành công',
            ],
            'groups' => [
                'create' => 'Tạo nhóm quyền thành công',
                'edit' => 'Cập nhật quyền thành công',
                'delete'   => 'Xóa nhóm quyền thành công'
            ],
        ]
    ]
];
