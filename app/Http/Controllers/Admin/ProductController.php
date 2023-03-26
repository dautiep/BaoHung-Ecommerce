<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    private $_prefix = 'admin.pages.products.';
    private $_productInterFace;
    private $_categoryInterFace;
    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface,
        CategoryRepositoryInterface $categoryRepositoryInterface
    )
    {
        $this->_productInterFace = $productRepositoryInterface;
        $this->_categoryInterFace = $categoryRepositoryInterface;
    }

    //get list products
    public function list(Request $request) {
        $status = config('global.default.status.products');
        $fromTo = $request->get('fromTo');
        $fromDate = NULL;
        $toDate = NULL;
        $res = explode(' - ', $fromTo);
        if (count($res) == 2) {
            $fromDate = $res[0];
            $toDate = $res[1] . ' 23:59:59';
        }
        $info = [
            'productName' => $request->get('productName', ''),
            'productStatus' => $request->get('productStatus', ''),
            'productCategory' => $request->get('productCategory', ''),
            'fromTo' => $request->get('fromTo', ''),
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'type' => 'SEARCH'
        ];
        $categories = $this->_categoryInterFace->getAllData();
        $products = $this->_productInterFace->searchWithInfo($info);
        return view($this->_prefix . 'list', compact('products', 'categories', 'info', 'status'));
    }

    //get create data form
    public function create() {
        $categories = $this->_categoryInterFace->getAllData();
        return view($this->_prefix . 'create', compact('categories'));
    }

    //save data
    public function save(ProductRequest $request, $id = null) {
        $input = $request->all();

        //slug product
        $input['productSlug'] = Str::slug($request['productName']);

        // display price product
        if (isset($input['productPrriceDisplayed'])) {
            $input['productPrriceDisplayed'] = 1;
        } else {
            $input['productPrriceDisplayed'] = 0;
        }

        //image product
        if (!empty($input['productImage'])) {
            $imageName = time() . '-' . $input['productSlug']. '.' .$input['productImage']->extension();
            $input['productImage']->move(public_path('admin/images/products'), $imageName);
            $input['productImageUrl'] = $imageName;
            //delete old image when update
            if ($id != null) {
                $product = $this->_productInterFace->find($id);
                File::delete(public_path('admin/images/products/' . $product->image_url));
            }
        } else {
            if ($id != null) {
                $product = $this->_productInterFace->find($id);
                $input['productImageUrl'] = $product->image_url;
            }
        }
        //save or update data
        $data = $this->_productInterFace->handleCreateOrUpdate($id, $input);
        if (!$data) {
            $message = config('global.default.messages.products.error');
            return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
        } else {
            $message = config('global.default.messages.products.save');
            return redirect()->route('products.list')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
        }
    }

    //get edit form data
    public function edit($id) {
        $product = $this->_productInterFace->find($id);
        $categories = $this->_categoryInterFace->getAllData();
        return view($this->_prefix . 'create', compact('product', 'categories'));
    }

    //lock data
    public function lock(Request $request) {
        try {
            $input = $request->all();
            $this->_productInterFace->lockOrUnlockByID($input);
            return Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.products.edit_status')]);
        } catch (Exception $e) {
            dd($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.products.error')]);
        }
    }

    //unlock data
    public function unlock(Request $request)
    {
        try {
            $input = $request->all();
            $this->_productInterFace->lockOrUnlockByID($input);
            return Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.products.edit_status')]);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.products.error')]);
        }
    }

    //upload image
    public function uploadImage(Request $request) {
        try {
            $input = $request->all();
            $imageName = time() . '-' . Str::random(20). '.' .$input['file']->extension();
            $input['file']->move(public_path('admin/images/products'), $imageName);
            $urlImage = '/admin/images/products/' . $imageName;
            return Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => 'upload image success', 'url' => $urlImage]);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return Response::json(['error' => $this::$TYPE_MESSAGES_ERROR, 'message' => 'Lỗi! Upload Fike']);
        }
    }
}
