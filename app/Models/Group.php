<?php

namespace App\Models;

use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, ScopeTrait;
    public $table = 'groups';
    public $fillable = [
        'user_id',
        'name',
        'group_role_json',
        'status',
        'is_active'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'group_role', 'group_id', 'role_id');
    }
}
