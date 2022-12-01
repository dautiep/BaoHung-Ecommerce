<?php

namespace App\Traits;

trait ScopeTrait
{
    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%' . $value . '%');
    }

    public function scopeWhereExplodeDate($query, $column, $value)
    {
        $res = explode(' - ', $value);
        if (count($res) == 2) {
            $fromDate = $res[0];
            $toDate = $res[1];

            return $query->whereBetween($column, [$fromDate, $toDate]);
        }
    }
    public function scopeWithWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }
}
