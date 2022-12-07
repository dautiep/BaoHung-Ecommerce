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

    public function updateRoleJson($role_id)
    {
        $builder = $this->model->whereHas('roles', function ($query) use ($role_id) {
            if ($role_id) {
                $query->where('role_id', $role_id);
            }
        })->get();
        foreach ($builder as $item) {
            $json_role = $this->getJsonPermissionToArray($item->roles->pluck('permission'))->toJson();
            $item->update([
                'group_role_json' => $json_role,
            ]);
        }
        return $builder;
    }

    public function getGroupRoleKey($roles)
    {
        //>whereJsonContains('group_role_json', $roles)
        $builder = $this->_model->with('users')->get();
        $user_role = [];
        $builder = $builder->map(function ($item, $value) use (&$user_role, $roles) {
            if (is_json($item->group_role_json)) {
                $array_roles = collect(json_decode($item->group_role_json, true))->flatten(1);
                if (@$array_roles->isNotEmpty() && @$array_roles->search($roles)) {
                    if (!@$item->users->isEmpty()) {
                        foreach ($item->users as $user) {
                            $user_role[] = $user->id;
                        }
                    }
                }
            }
        });
        return $user_role;
    }
}
