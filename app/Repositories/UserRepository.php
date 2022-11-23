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
        $builder =  $this->_model->where([
            'is_active' => User::USER_IS_ACTIVE
        ])->where(function ($query) use ($request) {
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
        $fillable = $request->only('name', 'email', 'password', 'is_active');
        if ($id == null) {
            return $this->create($fillable);
        }

        return $this->update($fillable, $id);
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
}
