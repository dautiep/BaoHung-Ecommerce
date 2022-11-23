<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Traits\HasPermissionsTrait;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{
    use HasPermissionsTrait;
    public $_model;
    public function __construct(Group $model)
    {
        $this->_model = $model;
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
        })->paginate($this->page);
        return $builder;
    }


    public function handleCreateOrUpdate($id, $request)
    {
        $builder = $this->_model->create($request->only('name', 'status'));
        if (!empty($request->get('roles'))) {
            $builder->roles()->sync($request->get('roles'));
            $roles = $builder->roles;
            if (!$roles->isEmpty()) {
                $json_role = $this->getJsonPermissionToArray($builder->roles->pluck('permission'))->toJson();
                $builder->update([
                    'group_role_json' => $json_role,
                ]);
            }
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
}
