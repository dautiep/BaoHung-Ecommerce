<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * get all data
     * @return mixed
     */
    public function getAllData();

    public function queryGlobal($columns, $with);


    /**
     * search with info
     * @param array $info
     * @return mixed
     */
    public function searchWithInfo(array $info);

    /**
     * handle save or update data
     * @param string $id
     * @param array $request
     * @return mixed
     */
    public function handleCreateOrUpdate(String $id, array $request);

    /**
     * lock or unlock data
     * @param array $request
     * @return mixed
     */
    public function lockOrUnlockByID(array $request);
}
