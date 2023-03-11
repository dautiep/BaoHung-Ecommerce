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
            'products' => [
                'actived' => [
                    'key' => 1,
                    'name' => 'Đang kinh doanh',
                    'action' => 'Ngừng kinh doanh'
                ],
                'unactived' => [
                    'key' => 0,
                    'name' => 'Đã ngừng kinh doanh',
                    'action' => 'Kinh doanh'
                ],
            ],
            'categories' => [
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
            'banner' => [
                'active' => [
                    'key' => 1,
                    'name' => 'Hoạt động'
                ],
                'deactive' => [
                    'key' => 0,
                    'name' => 'Khóa'
                ]
            ],
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
            'categories' => [
                'store' => 'Lưu danh mục thành công',
                'error' => 'Đã xảy ra lỗi!',
                'lock' => 'Đã khóa danh mục',
                'unlock' => 'Đã mở khóa danh mục',
                'edit'   => 'Chỉnh sửa danh mục thành công',

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
            'products' => [
                'save'   => 'lưu thông tin sản phẩm thành công',
                'edit' => 'Cập nhật sản phẩm thành công',
                'edit_status' => 'Đã thay đổi trạng thái sản phẩm',
                'error' => 'Đã xảy ra lỗi!',
            ],
            'banner' => [
                'create' => 'Thêm hình ảnh thành công',
                'edit' => 'Chỉnh sửa hình ảnh thành công',
                'edit_status' => 'Chỉnh sửa trạng thái hình ảnh thành công',
                'delete'   => 'Xóa hình ảnh thành công',
                'confirm_delete' => 'Bạn có muốn xóa banner này không?'

            ],
        ]
    ]
];
