<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\ServiceRepositoryInterface;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    private $_model;
    public function __construct(Service $model)
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
        if (!empty($info['serviceName'])) {
            $result = $result->where('name', 'like', "%" . $info['serviceName'] . "%");
        }
        if (!empty($info['fromDate']) && !empty($info['toDate'])) {
            $result = $result->where('created_at', '>=', $info['fromDate']);
            $result = $result->where('created_at', '<=', $info['toDate']);
        }
        if ($info['serviceStatus'] != '') {
            $result = $result->where('status', $info['serviceStatus']);
        }
        return $result->orderBy('created_at', 'DESC')->paginate(10);
    }

    //handle save or update data
    public function handleCreateOrUpdate($id, $request)
    {
        if ($id == null) {
            $status = config('global.default.status.services');
            return $this->_model->create(
                [
                    'name' => $request['serviceName'],
                    'user_id' => Auth::user()->id,
                    'status' => $status[0]['key']
                ]
            );
        }
        return $this->update(['name' => $request['serviceName']], $id);
    }

    //lock or unlock data
    public function lockOrUnlockByID($input)
    {
        $status = config('global.default.status.services');
        if ((int)$input['serviceStatus'] == $status[0]['key']) {
            return $this->update(['status' => $status[1]['key']], $input['serviceId']);
        } else {
            return $this->update(['status' => $status[0]['key']], $input['serviceId']);
        }
    }
}
