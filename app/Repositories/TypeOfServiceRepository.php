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


}
