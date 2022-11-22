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
                'create' => [
                    'message' => 'Thêm tài khoản thành công'
                ]
            ]
        ]
    ]
];
