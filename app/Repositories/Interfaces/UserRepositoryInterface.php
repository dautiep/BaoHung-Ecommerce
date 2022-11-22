<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getLists($request);
    public function handleCreateOrUpdate($id, $request);
    public function handleDelete($request);
}
