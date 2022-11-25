<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GroupRequest;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Traits\HasPermissionsTrait;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    use HasPermissionsTrait;
    private $_groupRepositoryInterface;
    private $_roleRepositoryInterface;
    private $_prefix = 'admin.pages.groups.';

    public function __construct(GroupRepositoryInterface $groupRepositoryInterface, RoleRepositoryInterface $roleRepositoryInterface)
    {
        $this->_groupRepositoryInterface = $groupRepositoryInterface;
        $this->_roleRepositoryInterface = $roleRepositoryInterface;
    }

    public function list(Request $request)
    {
        $info = $this->getBuilderSearch($request);
        $data = $this->_groupRepositoryInterface->getList($request);
        return view($this->_prefix . 'list', compact('data', 'info'));
    }

    public function create(Request $request)
    {
        $roles = $this->_roleRepositoryInterface->getAllByCondition();
        return view($this->_prefix . 'create', compact('roles'));
    }

    public function store(GroupRequest $request, $id = null)
    {
        $message = $id == null ?  config('global.default.messages.groups.create') : config('global.default.messages.groups.edit');
        $data = $this->_groupRepositoryInterface->handleCreateOrUpdate($id, $request);
        return redirect()->route('groups.list')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
    }

    public function delete(Request $request)
    {
        $data = $this->_groupRepositoryInterface->handleDelete($request);
        return response()->json($this->responseAjax(config('global.default.messages.groups.delete'), $this::$TYPE_MESSAGES_SUCCESS));
    }

    public function edit(Request $request, $id)
    {
        $data = $this->_groupRepositoryInterface->findWith($id, ['roles']);

        $roles = $this->_roleRepositoryInterface->getAllByCondition();

        return view($this->_prefix . 'create', compact('data', 'roles'));
    }

    public function state(Request $request)
    {
        $messages = config('global.default.messages.errors.update');
        $data = $this->_groupRepositoryInterface->handleUpdateState($request);
        if (!$data) {
            return response()->json($this->responseAjax($messages, $this::$TYPE_MESSAGES_SUCCESS));
        }
        return response()->json($this->responseAjax(config('global.default.messages.groups.edit_status'), $this::$TYPE_MESSAGES_SUCCESS));
    }
}
