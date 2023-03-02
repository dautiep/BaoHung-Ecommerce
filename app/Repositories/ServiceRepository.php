<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Interfaces\ServiceRepositoryInterface;

class TypeOfServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    private $_model;
    public function __construct(Service $model)
    {
        $this->_model = $model;
    }
}
