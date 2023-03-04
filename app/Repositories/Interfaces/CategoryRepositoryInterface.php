<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
<<<<<<< HEAD
    /**
     * get all data
     * @return mixed
     */
    public function getAllData();

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
=======
    public function getCategoryWithProduct($action = '');
>>>>>>> 57d830ed5beb40cb15e137806a19a7cf6295fac6
}
