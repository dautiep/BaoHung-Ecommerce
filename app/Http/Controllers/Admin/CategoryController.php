<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Exception;

class CategoryController extends Controller
{
    private $_prefix = 'admin.pages.categories.';
    private $_categoryInterFace;
    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->_categoryInterFace = $categoryRepositoryInterface;
    }

    //get list categories
    public function list(Request $request) {
        $status = config('global.default.status.categories');
        $fromTo = $request->get('fromTo');
        $fromDate = NULL;
        $toDate = NULL;
        $res = explode(' - ', $fromTo);
        if (count($res) == 2) {
            $fromDate = $res[0];
            $toDate = $res[1] . ' 23:59:59';
        }
        $info = [
            'categoryName' => $request->get('categoryName', ''),
            'categoryStatus' => $request->get('categoryStatus', ''),
            'fromTo' => $request->get('fromTo', ''),
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'type' => 'SEARCH'
        ];
        $categories = $this->_categoryInterFace->searchWithInfo($info);
        return view($this->_prefix . 'list', compact('categories', 'info', 'status'));
    }

    //create category
    public function create() {
        return view($this->_prefix . 'create');
    }

    //store or update category. If id = null. That stores data. if id != null. That updates data
    public function save(CategoryRequest $request, $id = null) {
        try {
            $input = $request->all();
            $data = $this->_categoryInterFace->handleCreateOrUpdate($id, $input);
            if (!$data) {
                $message = config('global.default.messages.categories.error');
                return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
            } else {
                $message = config('global.default.messages.categories.store');
                return redirect()->route('categories.list')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
            }
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            $message = config('global.default.messages.categories.error');
            return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
        }
    }

    //get data edit
    public function edit($id)
    {
        $category = $this->_categoryInterFace->find($id);
        return view($this->_prefix . 'create', compact('category'));
    }

    //lock data
    public function lock(Request $request)
    {
        try {
            $input = $request->all();
            $this->_categoryInterFace->lockOrUnlockByID($input);
            return Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.categories.lock')]);
        } catch (Exception $e) {
            dd($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.categories.error')]);
        }
    }

    //unlock data
    public function unlock(Request $request)
    {
        try {
            $input = $request->all();
            $this->_categoryInterFace->lockOrUnlockByID($input);
            return Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.categories.unlock')]);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.categories.error')]);
        }
    }




}
