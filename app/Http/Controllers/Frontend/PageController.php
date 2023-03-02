<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $_prefix;

    public function __construct()
    {
        $this->_prefix = config('template.config.blade_dir') . 'pages.';
    }

    public function index()
    {
        return view($this->_prefix . 'index');
    }

    public function category()
    {
        return view($this->_prefix . 'category');
    }

    public function productDetail()
    {
        return view($this->_prefix . 'product_detail');
    }

    public function contact()
    {
        return view($this->_prefix . 'contact');
    }
}
