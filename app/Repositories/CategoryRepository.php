<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    private $_model;
    public function __construct(Category $model)
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
        if (!empty($info['categoryName'])) {
            $result = $result->where('name', 'like', "%" . $info['categoryName'] . "%");
        }
        if (!empty($info['fromDate']) && !empty($info['toDate'])) {
            $result = $result->where('created_at', '>=', $info['fromDate']);
            $result = $result->where('created_at', '<=', $info['toDate']);
        }
        if ($info['categoryStatus'] != '') {
            $result = $result->where('status', $info['categoryStatus']);
        }
        return $result->orderBy('created_at', 'DESC')->paginate(10);
    }

    //handle save or update data
    public function handleCreateOrUpdate($id, $request)
    {
        if ($id == null) {
            $status = config('global.default.status.categories');
            return $this->_model->create(
                [
                    'name' => $request['categoryName'],
                    'user_id' => Auth::user()->id,
                    'status' => $status[0]['key']
                ]
            );
        }
        return $this->update(['name' => $request['categoryName']], $id);
    }

    //lock or unlock data
    public function lockOrUnlockByID($input)
    {
        $status = config('global.default.status.categories');
        if ((int)$input['categoryStatus'] == $status[0]['key']) {
            return $this->update(['status' => $status[1]['key']], $input['categoryId']);
        } else {
            return $this->update(['status' => $status[0]['key']], $input['categoryId']);
        }
    }


}
