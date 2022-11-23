<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private $_groupRepositoryInterface;
    private $_prefix = 'admin.pages.groups.';

    public function __construct(GroupRepositoryInterface $groupRepositoryInterface)
    {
        $this->_groupRepositoryInterface = $groupRepositoryInterface;
    }

    public function list(Request $request) {
        $info = $this->getBuilderSearch($request);
        $data = $this->_groupRepositoryInterface->getList($request);
        return view($this->_prefix . 'list', compact('data', 'info'));
    }
}
