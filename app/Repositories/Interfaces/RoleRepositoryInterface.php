<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getList($request);
    public function handleCreateOrUpdate($id, $request);
    public function handleDelete($request): bool;
    public function getAllByCondition($condition = []);
}
