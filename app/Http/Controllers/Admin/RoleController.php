<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Traits\HasPermissionsTrait;

class RoleController extends Controller
{
    use HasPermissionsTrait;
    private $_roleRepositoryInterface;
    private $_prefix = 'admin.pages.roles.';
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->_roleRepositoryInterface = $roleRepository;
    }

    public function list(Request $request)
    {
        $info = $this->getBuilderSearch($request);
        $data = $this->_roleRepositoryInterface->getList($request);
        return view($this->_prefix . 'list', compact('data', 'info'));
    }

    public function create(Request $request)
    {
        return view($this->_prefix . 'create');
    }

    public function config(Request $request)
    {
        return response()->json($this->getPermissionConvertJson());
    }

    public function store(RoleRequest $request, $id = null)
    {
        $message = $id == null ?  config('global.default.messages.roles.create') : config('global.default.messages.roles.edit');
        $data = $this->_roleRepositoryInterface->handleCreateOrUpdate($id, $request);
        return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
    }

    public function edit(Request $request, $id)
    {
        $data = $this->_roleRepositoryInterface->find($id);
        return view($this->_prefix . 'create', compact('data'));
    }

    public function delete(Request $request) {
        $data = $this->_roleRepositoryInterface->handleDelete($request);
        return response()->json($this->responseAjax(config('global.default.messages.roles.delete'), $this::$TYPE_MESSAGES_SUCCESS));
    }
}
