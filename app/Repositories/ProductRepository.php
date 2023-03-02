<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class TypeOfServiceRepository extends BaseRepository implements ProductRepositoryInterface
{
    private $_model;
    public function __construct(Product $model)
    {
        $this->_model = $model;
    }
}
