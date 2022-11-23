<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public $table = 'groups';
    public $fillable = [
        'user_id',
        'name',
        'group_role_json',
        'status'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'group_role', 'group_id', 'id');
    }
}
