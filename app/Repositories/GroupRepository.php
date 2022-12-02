<?php

namespace App\Repositories;

use App\Models\Group;
use App\Models\Role;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Traits\HasPermissionsTrait;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{
    use HasPermissionsTrait;
    public $_model;
    public $_modelRole;
    public function __construct(Group $model, Role $modelRole)
    {
        $this->_model = $model;
        $this->_modelRole = $modelRole;
        parent::__construct($model);
    }

    public function getList($request)
    {

        $builder =  $this->_model::with('roles')->where(function ($query) use ($request) {
            if (!empty($request->keySearch)) {
                $query->whereLike('name', $request->keySearch);
            }

            if (!empty($request->fromTo)) {
                $query->whereExplodeDate('created_at', $request->fromTo);
            }

            if (isset($request->status)) {
                $query->where('status', $request->status);
            }
        })->paginate($this->page);
        return $builder;
    }

    public function getAllByCondition($condition = [])
    {
        $builder = $this->_model->where(function ($query) use ($condition) {
            if (isset($condition['status'])) {
                $query->where('status', $condition['status']);
            }
        })->get();
        return $builder;
    }


    public function handleCreateOrUpdate($id, $request)
    {
        if ($id == null) {
            $builder = $this->_model->create($request->only('name', 'status'));
            $roles = $this->_modelRole->find($request['roles']);
        } else {
            $builder = $this->_model->find($id);
            $builder->update($request->only('name', 'status'));
            $roles = $builder->roles;
        }
        $builder->roles()->sync($request->get('roles'));
        if (!$roles->isEmpty()) {
            $json_role = $this->getJsonPermissionToArray($builder->roles->pluck('permission'))->toJson();
            $builder->update([
                'group_role_json' => $json_role,
            ]);
        }
        return $builder;
    }

    public function handleDelete($request)
    {
        $builder = $this->_model->find($request->get('itemId'));
        if (!$builder) {
            return false;
        }
        $builder->roles()->detach();
        return $builder->delete();
    }

    public function handleUpdateState($request)
    {

        $builder = $this->_model->find($request->get('itemId'),);
        if (!$builder) {
            return false;
        }
        return $builder->update([
            'status' => !$builder->status
        ]);
    }
}
