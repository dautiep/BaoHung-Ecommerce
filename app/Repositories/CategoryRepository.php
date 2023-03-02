<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    private $_model;
    public function __construct(Category $model)
    {
        $this->_model = $model;
        parent::__construct($model);
    }
}
