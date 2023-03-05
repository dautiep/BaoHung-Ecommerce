<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteConfigController extends Controller
{
    private $_prefix_router = 'frontend.';

    public function loadConfigurationNavigation($page_name = '')
    {
        return [
            [
                'name_page' => 'Trang chủ',
                'router_page' => route($this->_prefix_router . 'index'),
                'status_page' => true,
                'name_router' => $this->_prefix_router . 'index',
                'child_page' => [],
            ],
            [
                'name_page' => 'Loại sản phẩm',
                'router_page' => route($this->_prefix_router . 'category'),
                'name_router' => $this->_prefix_router . 'category',
                'status_page' => true,
                'child_page' => [],
            ],
            [
                'name_page' => 'Liên hệ',
                'router_page' => route($this->_prefix_router . 'contact'),
                'name_router' => $this->_prefix_router . 'contact',
                'status_page' => true,
                'child_page' => [],

            ]
        ];
    }

    public function loadConfigurationCategories()
    {
        return [
            'name_category' => 'Loại sản phẩm',
            'child_category' => [
                [
                    'name_category' => 'Sản phẩm A',
                    'router_category' => route($this->_prefix_router . 'contact'),
                    'name_router' => $this->_prefix_router . 'contact',
                    'status_category' => true,
                ],
                [
                    'name_category' => 'Sản phẩm B',
                    'router_category' => route($this->_prefix_router . 'contact'),
                    'name_router' => $this->_prefix_router . 'contact',
                    'status_page' => true,
                    'status_category' => true,

                    'child_category' => []
                ]
            ],

        ];
    }

    public function hasActiveRoutePage($route_name, $className = 'active')
    {
        return $route_name === request()->route()->getName() ? $className : '';
    }
}
