<?php

namespace App\Traits;

use App\Repositories\UserRepository;

trait Role
{
    public function scopeStaffRole($query, $column, $value)
    {
        return $query->where($column, $value);
    }

    public function scopeBossRole($query, $column, $value)
    {
        return $query->whereIn($column, $value);
    }
}
