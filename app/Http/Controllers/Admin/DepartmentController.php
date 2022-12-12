<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DepartmentRequest;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private $_departmentRepositoryInterface;
    private $_prefix = 'admin.pages.department.';
    public function __construct(DepartmentRepositoryInterface $departmentRepositoryInterface)
    {
        $this->_departmentRepositoryInterface = $departmentRepositoryInterface;
    }

    public function index(Request $request)
    {
        $title = 'Danh sách phòng ban';
        $info = $this->getBuilderSearch($request);
        $data = $this->_departmentRepositoryInterface->getList($request);
        return view($this->_prefix . 'list', compact('info', 'data', 'title'));
    }

    public function create(Request $request)
    {
        $title = 'Thông tin phòng ban';
        return view($this->_prefix . 'create', compact('title'));
    }

    public function store(DepartmentRequest $request, $id = null)
    {
        $message = $id == null ?  config('global.default.messages.department.create') : config('global.default.messages.department.edit');
        $data = $this->_departmentRepositoryInterface->handleCreateOrUpdate($request, $id);
        return redirect()->route('department.list')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
    }

    public function edit(Request $request, $id)
    {
        $title = 'Cập nhật phòng ban';

        $data = $this->_departmentRepositoryInterface->find((string)$id);
        return view($this->_prefix . 'create', compact('title', 'data'));
    }

    public function state(Request $request)
    {
        $messages = config('global.default.messages.errors.update');
        $data = $this->_departmentRepositoryInterface->handleUpdateState($request);
        if (!$data) {
            return response()->json($this->responseAjax($messages, $this::$TYPE_MESSAGES_SUCCESS));
        }
        return response()->json($this->responseAjax(config('global.default.messages.department.edit_status'), $this::$TYPE_MESSAGES_SUCCESS));
    }
}
