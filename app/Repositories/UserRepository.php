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
        $builder =  $this->findByWith([
            'is_active' => User::USER_IS_ACTIVE,
        ], ['groups']);
        return $builder;
    }

    public function handleCreateOrUpdate($id, $request)
    {
        if ($id == null) {
            return $this->create($request->only('name', 'email', 'password', 'is_active'));
        }
        return $this->update($request->only('name', 'email', 'password', 'is_active'), $id);
    }
}
