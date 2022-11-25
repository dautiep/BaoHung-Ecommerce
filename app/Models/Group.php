<?php

namespace App\Models;

use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, ScopeTrait;
    public $table = 'groups';
    public static $STATUS_ACTIVE = 1;
    public $fillable = [
        'user_id',
        'name',
        'group_role_json',
        'status',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'group_role', 'group_id', 'role_id');
    }
}
