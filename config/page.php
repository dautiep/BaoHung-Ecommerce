<?php

return [
    'title' => 'Project',
    'btn_view_product' => 'Xem chi tiết',
    'total_product_with_category'=> 'Sản phẩm',
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
    ]
];
