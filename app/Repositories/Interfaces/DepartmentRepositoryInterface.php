<?php

namespace App\Repositories\Interfaces;

interface DepartmentRepositoryInterface extends BaseRepositoryInterface
{
    public function getList($request);
    public function handleCreateOrUpdate($request, $id);
    public function getSelectedAll($condition = []);
    public function handleUpdateState($request);
}
