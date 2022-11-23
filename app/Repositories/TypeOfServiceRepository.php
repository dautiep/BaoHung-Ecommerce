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

    //search with info from fe
    public function searchWithInfo($info) {
        $result = $this->_model;
        if (!empty($info['serviceName'])) {
            $result = $result->where('name', 'like', "%".$info['serviceName']."%");
        }
        if (!empty($info['fromDate']) && !empty($info['toDate'])) {
            $result = $result->where('created_at', '>=', $info['fromDate']);
            $result = $result->where('created_at', '<=', $info['toDate']);
        }
        return $result->orderBy('created_at','DESC')->paginate(10);
    }

    //handle save or update data
    public function handleCreateOrUpdate($id, $request) {
        if ($id == null) {
            $idValue = Str::random(3);
            return $this->_model->create([
                    'id' => $idValue,
                    'name' => $request['serviceName'],
                    'user_id' => Auth::user()->id
                ]
            );
        }
        return $this->update(['name' => $request['serviceName']], $id);
    }


}
