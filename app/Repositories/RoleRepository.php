<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    private $_model;
    public function __construct(Role $model)
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

    public function handleCreateOrUpdate($id, $request)
    {
        if ($id == null) {
            $builder = $this->_model->create($request->only('name', 'permission'));
        } else {
            $builder = $this->_model->find($id)->update($request->only('name', 'permission'));
            if($builder) {
                // sync role update group json
                $this->handSyncRoleGroupJson($id);
            }
        }

        return $builder;
    }

    public function handSyncRoleGroupJson($id_role)
    {
        $group_intansce = app(GroupRepository::class)->updateRoleJson($id_role);
        return $group_intansce;
    }

    public function handleDelete($request): bool
    {
        return $this->destroyGlobalByCondition($this->_model, [
            'key' => 'id',
            'arrId' => [
                $request->get('itemId'),
            ]
        ], 'array');
    }

    public function getAllByCondition($condition = [])
    {
        return $this->_model->all();
    }
}
