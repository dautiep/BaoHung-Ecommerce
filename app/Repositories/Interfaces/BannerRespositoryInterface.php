<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface BannerRespositoryInterface extends BaseRepositoryInterface
{
    public function getList($request);
    public function handleDelete($request);
    public function handleCreateOrUpdate($id, $request);
    public function lockOrUnlockByID($input);
}
