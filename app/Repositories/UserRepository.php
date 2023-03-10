<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    private $_model;
    public function __construct(User $model)
    {
        $this->_model = $model;
        parent::__construct($model);
    }

    public function getLists($request)
    {
        $builder =  $this->_model::with(['groups'])->whereHas('groups', function ($query) use ($request) {
            if (!empty($request->get('groups'))) {
                $query->where('group_id', $request->get('groups'));
            }
        })->where(function ($query) use ($request) {
            if (!empty($request->keySearch)) {
                $query->whereLike('name', $request->keySearch);
            }

            if (isset($request->department_id)) {
                $query->where('department_id', $request->department_id);
            }

            if (!empty($request->fromTo)) {
                $query->whereExplodeDate('created_at', $request->fromTo);
            }

            if (isset($request->is_active)) {
                $query->where('is_active', $request->is_active);
            }
        })->where([[
            'id', '<>', auth()->user()->id
        ], [
            'is_admin', '<>', User::IS_ADMIN
        ]])->paginate($this->page);
        return $builder;
    }

    public function handleCreateOrUpdate($id, $request)
    {
        if ($request->get('groups')[0] == '3') {
            $fillable = $request->only('name', 'email', 'password', 'is_active');
        } else {
            $fillable = $request->only('name', 'email', 'password', 'is_active', 'department_id');
        }
        if ($id == null) {
            $builder = $this->create($fillable);
        } else {
            $builder = $this->_model->find($id);
            if (!$builder) {
                return false;
            }
            $builder->update($fillable);
        }
        $builder->groups()->sync($request->get('groups', []));

        return $builder;
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

    public function handleUpdateState($request)
    {

        $builder = $this->_model->find($request->get('itemId'),);
        if (!$builder) {
            return false;
        }
        return $builder->update([
            'is_active' => !$builder->is_active
        ]);
    }

    public function getListIdByDepartmentId($departmentId)
    {
        return $this->_model->where('department_id', $departmentId)->pluck('id')->toArray();
    }

    public function getListUserByFaqAssginment($partmentId)
    {

        $builder = $this->_model->select('id', 'name')->where(function ($query) use($partmentId) {
            if (is_can(['faq.assignUser'])) {
                $user_id = app(GroupRepository::class)->getGroupRoleKey('faq.listStaff');
                $query->whereIn('id', $user_id);
                $query->where('department_id', $partmentId);
            }
        })->get()->map(function($item,$value) {
            return [
                'key' => $item->id,
                'name' => $item->name
            ];
        })->toArray();
        return $builder;
    }
}
