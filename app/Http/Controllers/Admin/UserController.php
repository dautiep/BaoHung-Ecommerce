<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $_userRepository;
    private $_prefix = 'admin.pages.users.';
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->_userRepository = $userRepositoryInterface;
    }

    public function list(Request $request)
    {
        $info = [
            'keySearch' => $request->get('keySearch', ''),
            'fromTo' => $request->get('fromTo', ''),
            'fromDate' => null,
            'toDate' => null,
            'type' => 'SEARCH'
        ];
        $data = $this->_userRepository->getLists($request);
        return view($this->_prefix . 'list', compact('info', 'data'));
    }

    public function create(Request $request)
    {
        return view($this->_prefix . 'create');
    }

    public function delete(Request $request)
    {
    }

    public function store(UserStoreRequest $request, $id = null)
    {
        $message = config('global.default.messages.users.create');
        $data = $this->_userRepository->handleCreateOrUpdate($id, $request);
        return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
    }
}
