<?php

namespace App\Repositories;

use App\Models\TypeOfService;
use App\Repositories\Interfaces\TypeOfServiceRepositoryInterface;

class TypeOfServiceRepository extends BaseRepository implements TypeOfServiceRepositoryInterface
{
    private $_model;
    public function __construct(TypeOfService $model)
    {
        $this->_model = $model;
        parent::__construct($model);
    }

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


}
