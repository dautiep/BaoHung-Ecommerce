<?php

return [
    'title' => 'Công Nghệ và hơn thế nữa...',
    'short_title' => 'P',
    'btn_view_product' => 'Xem chi tiết',
    'input_search_on_page' => 'Tìm kiếm sản phẩm',
    'total_product_with_category' => 'Sản phẩm',
    'login_admin' => [
        'name' => 'Đăng nhập',
        'route_name' => 'dashboard'
    ],
    'filter_product' => [
        'name' => 'Lọc theo giá',
        'filter_range' => [
            [
                'label' => 'Tất cả',
                'target' => 'all',
                'id' => 'price-all'
            ],
            [
                'label' => 'đ 10.000 - đ 20.000',
                'target' => '10000-20000',
                'id' => 'price-1'
            ],
            [
                'label' => 'đ 30.000 - đ 40.000',
                'target' => '30000-40000',
                'id' => 'price-2'
            ],
            [
                'label' => 'đ 50.000 - đ 60.000',
                'target' => '50000-60000',
                'id' => 'price-3'
            ]
        ],
    ],
    'error' => [
        '404' => [
            'label' => 'Không tìm thấy trang yêu cầu',
            'error' => '404'
        ]
    ],
    'footer' => [
        'description' => 'Giới thiệu về showroom',
        'map_market' => 'Địa chỉ showroom: 572A/11 Trần Hưng Đạo, Phường 2, Quận 5, TP.HCM',
        'phone_number' => '(+84) 2838382054',
        'hotline-1' => 'Hotline 1: Cô Thảo - 0909085634',
        'hotline-2' => 'Hotline 2: Anh Duy - 0932121063',
        'email' => 'Email: peterduy@gmail.com'
    ]
];
