<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Models\Group;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $_userRepository;
    private $_groupRepository;
    private $_prefix = 'admin.pages.users.';
    public function __construct(UserRepositoryInterface $userRepositoryInterface, GroupRepositoryInterface $groupRepositoryInterface)
    {
        $this->_userRepository = $userRepositoryInterface;
        $this->_groupRepository = $groupRepositoryInterface;
    }

    public function list(Request $request)
    {
        $info = $this->getBuilderSearch($request);
        $data = $this->_userRepository->getLists($request);
        $groups = $this->_groupRepository->getAllByCondition();
        return view($this->_prefix . 'list', compact('info', 'data', 'groups'));
    }

    public function create(Request $request)
    {
        $groups = $this->_groupRepository->getAllByCondition([
            'status' => Group::$STATUS_ACTIVE
        ]);
        return view($this->_prefix . 'create', compact('groups'));
    }

    public function delete(Request $request)
    {
        $data = $this->_userRepository->handleDelete($request);
        return response()->json($this->responseAjax(config('global.default.messages.users.delete'), $this::$TYPE_MESSAGES_SUCCESS));
    }

    public function store(UserStoreRequest $request, $id = null)
    {
        $message = $id == null ?  config('global.default.messages.users.create') : config('global.default.messages.users.edit');
        $data = $this->_userRepository->handleCreateOrUpdate($id, $request);
        return redirect()->route('users.list')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
    }

    public function edit(Request $request, $id)
    {
        $data = $this->_userRepository->findWith($id, ['groups']);
        $groups = $this->_groupRepository->getAllByCondition([
            'status' => Group::$STATUS_ACTIVE
        ]);
        return view($this->_prefix . 'create', compact('data', 'groups'));
    }

    public function state(Request $request)
    {
        $messages = config('global.default.messages.errors.update');
        $data = $this->_userRepository->handleUpdateState($request);
        if (!$data) {
            return response()->json($this->responseAjax($messages, $this::$TYPE_MESSAGES_SUCCESS));
        }
        return response()->json($this->responseAjax(config('global.default.messages.users.edit_status'), $this::$TYPE_MESSAGES_SUCCESS));
    }
}
