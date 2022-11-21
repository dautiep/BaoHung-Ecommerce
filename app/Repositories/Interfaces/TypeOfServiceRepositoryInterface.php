<?php
namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;

interface TypeOfServiceRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * search with info
     * @param array $info
     * @return mixed
     */
    public function searchWithInfo(array $info);
}
