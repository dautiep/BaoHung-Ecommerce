<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $_prefix;
    private $_prefix_router = 'frontend.';
    private $_repo_category;
    private $_repo_product;
    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface, ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->_prefix = config('template.config.blade_dir') . 'pages.';
        $this->_repo_category = $categoryRepositoryInterface;
        $this->_repo_product = $productRepositoryInterface;
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
        ])->where([['slug', '=', $request->slug]])->first();
        if (!$categories_with_product) {
            return abort(404);
        }
        $this->setHeaderPage($categories_with_product->name, [
            $this->configPage('Trang chủ', $this->_prefix_router . 'index'),
            $this->configPage($categories_with_product->name, $this->_prefix_router . 'category', ['slug' => $categories_with_product->slug])
        ]);
        $all_products =  collect($categories_with_product->productWithCategory()->get()->toArray());
        $categories_with_product_filter = collect(config('page.filter_product.filter_range'))->map(function ($item) use ($all_products) {
            if (@$item['id'] == 'price-all') {
                return array_merge([
                    'total_product' => $all_products->count()
                ], $item);
            } else {
                $ranger_filter = explode('-', $item['target']);
                $count_ranger = $all_products->whereBetween('price', [
                    $ranger_filter[0],
                    $ranger_filter[1]
                ]);
                return array_merge([
                    'total_product' => $count_ranger->count()
                ], $item);
            }
        });
        $categories_with_product->setRelation('productWithCategory', $categories_with_product->productWithCategory()->paginate(10));
        $this->setCategoriesWithProductFilterRanger($categories_with_product_filter);
        $this->setCategoriesWithProduct($categories_with_product);
        return view($this->_prefix . 'category');
    }

    public function categoryFilter(Request $request)
    {
        $categories_with_product = $this->_repo_category->queryGlobal([
            'name',
            'id',
            'slug'
        ], [
            'productWithCategory'
        ])->where([['slug', '=', $request->slug]])->first();
        if (!$categories_with_product) {
            return abort(404);
        }
        $all_products =  collect($categories_with_product->productWithCategory()->get());
        $config_filter = collect(config('page.filter_product.filter_range'));
        $categories_with_product_filter = $config_filter->map(function ($item) use ($all_products) {
            if (@$item['id'] == 'price-all') {
                return array_merge([
                    'total_product' => $all_products->count()
                ], $item);
            } else {
                $ranger_filter = explode('-', $item['target']);
                $count_ranger = $all_products->whereBetween('price', [
                    $ranger_filter
                ]);
                return array_merge([
                    'total_product' => $count_ranger->count()
                ], $item);
            }
        });
        $product_with_category =  $categories_with_product->productWithCategory()->where(function ($query) use ($request, $config_filter) {
            if ($request->get('targetRanger')) {
                $json_decode_target = json_decode($request->get('targetRanger'), true);
                $config_filter = $config_filter->where('id', $json_decode_target[0])->first();
                if ($config_filter && $config_filter['target'] !== 'all') {
                    $ranger_filter = explode('-', $config_filter['target']);
                    $query->whereBetween('price', $ranger_filter);
                }
            }
        })->paginate(10);
        $categories_with_product->setRelation('productWithCategory',$product_with_category);
        $this->setCategoriesWithProductFilterRanger($categories_with_product_filter);
        $this->setCategoriesWithProduct($categories_with_product);
        return view(config('template.config.blade_dir') . 'components.product_category')->render();
    }

    public function productDetail(Request $request)
    {
        $this->setHeaderCarouel(false);
        $product_detail = $this->_repo_product->queryGlobal([
            'id',
            'name',
            'slug',
            'description',
            'content',
            'price',
            'category_id',
            'image_url'
        ], false)->where('slug', '=', $request->slug)->first();
        $categories_with_product = $this->_repo_category->queryGlobal([
            'name',
            'id',
            'slug'
        ], [
            'productWithCategory'
        ])->where([['id', '=', $product_detail->category_id]])->first();
        $this->setCategoriesWithProduct($categories_with_product);
        $categories_with_product->setRelation('productWithCategory', $categories_with_product->productWithCategory()->take(4)->get());
        $this->setProductDetail($product_detail);
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
    private function setCategoriesWithProductFilterRanger($data)
    {
        return view()->share('categories_with_product_filter', $data);
    }
    private function setProductDetail($data)
    {
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
