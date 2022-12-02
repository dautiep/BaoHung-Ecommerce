<?php

namespace App\Repositories;

use App\Models\Department;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    public $_model;
    public function __construct(Department $department)
    {
        $this->_model = $department;
        parent::__construct($department);
    }

    public function getList($request)
    {
        $builder = $this->_model->where(function ($query) use ($request) {
            if (!empty($request->keySearch)) {
                $query->whereLike('name', $request->keySearch);
            }

            if (!empty($request->fromTo)) {
                $query->whereExplodeDate('created_at', $request->fromTo);
            }

            if (isset($request->status)) {
                $query->where('status', $request->status);
            }
        });
        return $builder->paginate($this->page);
    }

    public function handleCreateOrUpdate($request, $id)
    {
        $builder = $this->_model;
        if ($id == null) {
            return $builder->create([
                'name' => $request->name,
                'status' => config('global.default.status.department.active.key')
            ]);
        }
        $builder = $builder->find($id);
        return $builder->update([
            'name' => $request->name,
        ]);
    }

    public function getSelectedAll($condition = [])
    {
        return $this->_model->select('id', 'name')->where('status', config('global.default.status.department.active.key'))->get()->map(function ($item) {
            return [
                'key' => $item->id,
                'name' => $item->name
            ];
        });
    }
}
