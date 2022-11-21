<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    private $_model;
    public function __construct(Role $model)
    {
        $this->_model = $model;
    }
}
