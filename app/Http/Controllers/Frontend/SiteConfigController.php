<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepository;
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

        $ins_repo = app(CategoryRepository::class)->getSelectData([
            'name',
            'slug'
        ]);
        $router = $this->_prefix_router . 'category';
        $nav_category = collect($ins_repo)->map(function ($item) use ($router) {
            return [
                'name_category' => $item->name,
                'router_category' => route($router, ['slug' => $item->slug]),
                'name_router' => $router,
                'status_category' => true,
                'child_category' => []
            ];
        })->toArray();

        return [
            'name_category' => 'Loại sản phẩm',
            'child_category' => $nav_category
        ];
    }

    public function hasActiveRoutePage($route_name, $className = 'active')
    {
        return $route_name === request()->route()->getName() ? $className : '';
    }
}
