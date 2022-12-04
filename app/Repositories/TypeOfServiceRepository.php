<?php

namespace App\Repositories;

use App\Models\TypeOfService;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\TypeOfServiceRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TypeOfServiceRepository extends BaseRepository implements TypeOfServiceRepositoryInterface
{
    private $_model;
    public function __construct(TypeOfService $model)
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
            $idValue = Str::random(3);
            return $this->_model->create(
                [
                    'id' => $idValue,
                    'name' => $request['serviceName'],
                    'user_id' => Auth::user()->id
                ]
            );
        }
        return $this->update(['name' => $request['serviceName']], $id);
    }


    public function lockOrUnlockByID($input)
    {
        $status = config('global.default.status.type_of_services');
        if ((int)$input['serviceStatus'] == $status[0]['key']) {
            return $this->update(['status' => $status[1]['key']], $input['serviceId']);
        } else {
            return $this->update(['status' => $status[0]['key']], $input['serviceId']);
        }
    }

    public function getTypeOfService()
    {
        $status = config('global.default.status.type_of_services');
        return $this->_model->where('status', '=', $status[0]['key'])->get();
    }

    public function findWithRelation(string $id, $relationships = [])
    {
        $status = config('global.default.status.type_of_services');
        return $this->_model->where([
            ['status', '=', $status[0]['key']],
            ['id', '=', $id]
        ])->with($relationships)->first();
    }
}
