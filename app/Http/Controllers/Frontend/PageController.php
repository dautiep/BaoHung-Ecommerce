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
}
