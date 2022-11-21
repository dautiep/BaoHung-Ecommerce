<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\Interfaces\GroupRepositoryInterface;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{
    private $_model;
    public function __construct(Group $group)
    {
        $this->_model = $group;
    }
}
