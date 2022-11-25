<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface GroupRepositoryInterface extends BaseRepositoryInterface
{
    public function getList($request);
    public function handleCreateOrUpdate($id, $request);
    public function handleDelete($request);
    public function getAllByCondition($condition = []);
}
