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
            ]
        ],
        'messages' => [
            'users' => [
                'create' => 'Thêm tài khoản thành công',
                'edit' => 'Chỉnh sửa tài khoản thành công',
            ],
            'type_of_services' => [
                'store' => 'Lưu thông tin dịch vụ thành công',
                'error' => 'Lưu thông tin dịch vụ thất bại',
                'create' => 'Thêm tài khoản thành công',
                'delete' => 'Xóa tài khoản thành công',
                'edit'   => 'Chỉnh sửa tài khoản thành công',
            ],
            'roles' => [
                'create' => 'Thêm bộ quyền thành công',
                'edit' => 'Edit quyền thành công',
                'delete'   => 'Xóa quyền thành công',
            ]
        ]
    ]
];
