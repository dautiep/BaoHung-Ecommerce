<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Repositories\Interfaces\BannerRespositoryInterface;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $_banner_repo;
    private $_prefix = 'admin.pages.banners.';

    public function __construct(BannerRespositoryInterface $bannerRespositoryInterface)
    {
        $this->_banner_repo = $bannerRespositoryInterface;
    }

    public function index(Request $request)
    {
        $info = $this->getBuilderSearch($request);
        $data = $this->_banner_repo->getList($request);
        return view($this->_prefix . 'index', compact('info', 'data'));
    }

    public function store(BannerRequest $request, $id = null)
    {
        $message = $id == null ?  config('global.default.messages.banner.create') : config('global.default.messages.banner.edit');

        $data = $this->_banner_repo->handleCreateOrUpdate($id, $request);
        return redirect()->route('config_banner.index')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
    }
    public function create(Request $request)
    {
        return view($this->_prefix . 'create');
    }

    public function delete(Request $request)
    {
        $data = $this->_banner_repo->handleDelete($request);
        return response()->json($this->responseAjax(config('global.default.messages.banner.delete'), $this::$TYPE_MESSAGES_SUCCESS));
    }

    public function status(Request $request)
    {
        $message = request()->itemId == null ?  config('global.default.messages.banner.create') : config('global.default.messages.banner.edit');

        $data = $this->_banner_repo->lockOrUnlockByID($request);
        return response()->json($this->responseAjax($message, $this::$TYPE_MESSAGES_SUCCESS));
    }
    public function edit(Request $request, $id)
    {
        $data = $this->_banner_repo->findOneOrFail($id);

        return view($this->_prefix . 'create', compact('data'));
    }
}
