<?php

namespace App\Repositories;

use App\Helpers\FileManager;
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

    //get data by status
    public function getAllDataByStatus($status)
    {
        return $this->_model->where('status', $status['key'])->select('name', 'description', 'img_src')->get();
    }

    //get all data
    public function getAllData()
    {
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
        $rec = $this->_model->find($id);
        $request['img_src'] = app(FileManager::class)->handleUpdateImage($rec, $request, 'admin/images/services/') ?? "";
        if ($id == null) {
            $status = config('global.default.status.services');
            return $this->_model->create(
                [
                    'name' => $request['serviceName'],
                    'description' => $request['serviceDescription'],
                    'user_id' => Auth::user()->id,
                    'status' => $status[0]['key'],
                    'img_src' => $request['img_src'],
                ]
            );
        }
        return $this->update([
            'name' => $request['serviceName'],
            'description' => $request['serviceDescription'],
            'img_src' => $request['img_src'],
        ], $id);
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
