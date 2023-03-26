<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    private $_model;
    public function __construct(Product $model)
    {
        $this->_model = $model;
        parent::__construct($model);
    }

    //get all data
    public function getAllData() {
        return $this->_model->select('name')->get();
    }

    //search with info from fe
    public function searchWithInfo($info)
    {
        $result = $this->_model;
        if (!empty($info['productName'])) {
            $result = $result->where('name', 'like', "%" . $info['productName'] . "%");
        }
        if (!empty($info['productCategory'])) {
            $result = $result->where('category_id', $info['productCategory']);
        }
        if (!empty($info['fromDate']) && !empty($info['toDate'])) {
            $result = $result->where('created_at', '>=', $info['fromDate']);
            $result = $result->where('created_at', '<=', $info['toDate']);
        }
        if ($info['productStatus'] != '') {
            $result = $result->where('status', $info['productStatus']);
        }
        return $result->with('category')->orderBy('created_at', 'DESC')->paginate(10);
    }

    //handle save or update data
    public function handleCreateOrUpdate($id, $request)
    {
        $status = config('global.default.status.products');
        if ($id == null) {
            return $this->_model->create(
                [
                    'name' => $request['productName'],
                    'slug' => $request['productSlug'],
                    'price' => $request['productPrice'],
                    'description' => $request['productDescription'],
                    'category_id' => $request['productCategory'],
                    'content' => $request['productContent'],
                    'status' => $status['actived']['key'],
                    'image_url' => $request['productImageUrl'],
                    'is_displayed_price' => $request['productPrriceDisplayed']
                ]
            );
        }
        return $this->update([
            'name' => $request['productName'],
            'slug' => $request['productSlug'],
            'price' => $request['productPrice'],
            'description' => $request['productDescription'],
            'category_id' => $request['productCategory'],
            'content' => $request['productContent'],
            'image_url' => $request['productImageUrl'],
            'is_displayed_price' => $request['productPrriceDisplayed']
        ], $id);
    }

    //lock or unlock data
    public function lockOrUnlockByID($input)
    {
        $status = config('global.default.status.products');
        if ((int)$input['productStatus'] == $status['actived']['key']) {
            return $this->update(['status' => $status['unactived']['key']], $input['productId']);
        } else {
            return $this->update(['status' => $status['actived']['key']], $input['productId']);
        }
    }

    public function queryGlobal($columns, $with)
    {

        $query = $this->_model->selectRaw(implode(", ",$columns));
        $query = $with ? $query->with($with) : $query;
        return $query->where('status', config('global.default.status.products.actived.key'));
    }
}
