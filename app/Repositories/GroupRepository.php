<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\Interfaces\GroupRepositoryInterface;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{
    private $_model;
    public function __construct(Group $model)
    {
        $this->_model = $model;
        parent::__construct($model);
    }

    public function getList($request)
    {

        $builder =  $this->_model->where(function ($query) use ($request) {
            if (!empty($request->keySearch)) {
                $query->whereLike('name', $request->keySearch);
            }

            if (!empty($request->fromTo)) {
                $query->whereExplodeDate('created_at', $request->fromTo);
            }
        })->paginate($this->page);
        return $builder;
    }

}
