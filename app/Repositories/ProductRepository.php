<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    private $_model;
    public function __construct(Product $model)
    {
        $this->_model = $model;
    }

    public function queryGlobal($columns, $with)
    {

        $query = $this->_model->selectRaw(implode(", ",$columns));
        $query = $with ? $query->with($with) : $query;
        return $query;
    }
}
