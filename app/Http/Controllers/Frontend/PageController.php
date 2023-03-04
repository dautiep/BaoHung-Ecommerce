<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $_prefix;
    private $_prefix_router = 'frontend.';
    private $_repo_category;
    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->_prefix = config('template.config.blade_dir') . 'pages.';
        $this->_repo_category = $categoryRepositoryInterface;
    }

    public function index()
    {
        $this->setHeaderCarouel(true);
        $categories_with_product = $this->_repo_category->getCategoryWithProduct();
        $this->setCategoriesWithProduct($categories_with_product);
        return view($this->_prefix . 'index');
    }

    public function category(Request $request)
    {
        $categories_with_product = $this->_repo_category->queryGlobal([
            'name',
            'id',
            'slug'
        ], [
            'productWithCategory'
        ])->first();
        if (!$categories_with_product) {
            return abort(404);
        }
        $this->setHeaderPage($categories_with_product->name, [
            $this->configPage('Trang chủ', $this->_prefix_router . 'index'),
            $this->configPage($categories_with_product->name, $this->_prefix_router . 'category', ['slug' => $categories_with_product->slug])
        ]);

        $categories_with_product->setRelation('productWithCategory', $categories_with_product->productWithCategory()->paginate(10));
        $this->setCategoriesWithProduct($categories_with_product);
        return view($this->_prefix . 'category');
    }

    public function productDetail(Request $request)
    {
        $this->setHeaderCarouel(false);

        return view($this->_prefix . 'product_detail');
    }

    public function contact()
    {
        $this->setHeaderPage('Liên hệ', [
            $this->configPage('Trang chủ', $this->_prefix_router . 'index'),
            $this->configPage('Liên hệ', $this->_prefix_router . 'contact')
        ]);
        return view($this->_prefix . 'contact');
    }

    private function setHeaderPage($pageName, $breadcrumbs = [])
    {
        $config_page = [
            'page_name' => $pageName,
            'bread_crumbs' => $breadcrumbs,
        ];
        view()->share('header_setting', $config_page);
    }

    private function setHeaderCarouel($status = false, $carousel_item = [])
    {
        $config_page = [
            'status' => $status,
            'carousel_item' => [
                [
                    'title' => '10% Off Your First Order',
                    'description' => 'Fashionable Dress',
                    'href' => '#',
                    'btn_title' => 'Shop now',
                    'btn_href' => '',
                    'img_src' => templateAsset('img/carousel-1.jpg'),
                    'img_alt' => '',
                ],
                [
                    'title' => '10% Off Your First Order',
                    'description' => 'Fashionable Dress',
                    'href' => '#',
                    'btn_title' => 'Shop now',
                    'btn_href' => '#',
                    'img_src' => templateAsset('img/carousel-2.jpg'),
                    'img_alt' => '',
                ]
            ]
        ];
        view()->share('header_carouel', $config_page);
    }

    private function setCategoriesWithProduct($data)
    {
        view()->share('categories_with_product', $data);
    }

    private function setProductDetail($data) {
        view()->share('product_detail', $data);
    }

    private function configPage($name_page, $name_router, $child = [], $status = true)
    {
        return  [
            'name_page' => $name_page,
            'router_page' => route($name_router),
            'name_router' => $name_router,
            'status_page' => $status,
            'child_page' => [],

        ];
    }
}
