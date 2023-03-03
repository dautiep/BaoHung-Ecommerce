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
                'active' => [
                    'key' => 1,
                    'name' => 'Hoạt động'
                ],
                'deactive' => [
                    'key' => 0,
                    'name' => 'Khóa tài khoản'
                ]
            ],
            'services' => [
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
            'orther_faqs' => [
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
            ],
            'question' => [
                [
                    'key' => 2,
                    'name' => 'Đang chờ duyệt',
                    'action' => 'Duyệt câu hỏi'
                ],
                [
                    'key' => 1,
                    'name' => 'Đang chạy',
                    'action' => 'Khóa câu hỏi'
                ],
                [
                    'key' => 0,
                    'name' => 'Đã khóa',
                    'action' => 'Mở khóa câu hỏi'
                ]
            ],
            'groups' => [
                'active' => [
                    'key' => 1,
                    'name' => 'Hoạt động'
                ],
                'deactive' => [
                    'key' => 0,
                    'name' => 'Khóa'
                ]
            ],
            'department' => [
                'active' => [
                    'key' => '1',
                    'name' => 'Hoạt động'
                ],
                'deactive' => [
                    'key' => 0,
                    'name' => 'Khóa'
                ]
            ]

        ],
        'messages' => [
            'users' => [
                'create' => 'Thêm tài khoản thành công',
                'edit' => 'Chỉnh sửa tài khoản thành công',
                'edit_status' => 'Chỉnh sửa trạng thái tài khoản thành công',
            ],
            'services' => [
                'store' => 'Lưu thông tin dịch vụ thành công',
                'error' => 'Đã xảy ra lỗi!',
                'lock' => 'Đã khóa dịch vụ',
                'unlock' => 'Đã mở khóa dịch vụ',
                'edit'   => 'Chỉnh sửa dịch vụ thành công',
            ],
            'question_answer_service' => [
                'store' => 'Lưu thông tin câu hỏi thành công',
                'error' => 'Đã xảy ra lỗi!',
                'approved' => 'Đã duyệt câu hỏi',
                'lock' => 'Đã khóa câu hỏi',
                'unlock' => 'Đã mở khóa câu hỏi',
                'edit'   => 'Chỉnh sửa câu hỏi thành công',

            ],
            'roles' => [
                'create' => 'Thêm bộ quyền thành công',
                'edit' => 'Cập nhật quyền thành công',
                'delete'   => 'Xóa quyền thành công',
            ],
            'groups' => [
                'create' => 'Tạo nhóm quyền thành công',
                'edit' => 'Cập nhật quyền thành công',
                'delete'   => 'Xóa nhóm quyền thành công',
                'edit_status' => 'Chỉnh sửa trạng thái nhóm quyền thành công',
            ],
            'errors' => [
                'update' => 'Lỗi phát sinh khi cập nhật dữ liệu',
            ],
            'orther_faqs' => [
                'confirm_delete'   => 'Xác nhận có xóa câu hỏi',
                'not_found' => 'Không tìm thấy kết quả',
                'content_to_consult' => 'Cập nhật câu trả lời thành công',
                'not_required_answer' => 'Vui lòng điền câu trả lời',
                'delete' => 'Đã xóa thành công',
                'not_assgiment_answer' => 'Vui lòng chọn người phụ trách',
            ],
            'department' => [
                'create' => 'Tạo phòng ban thành công',
                'edit' => 'Cập nhật phòng ban thành công',
                'delete'   => 'Xóa phòng ban thành công',
                'edit_status' => 'Chỉnh sửa trạng thái phòng ban thành công',
            ]
        ]
    ]
];
