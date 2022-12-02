<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public $table = 'department';
    public $appends = [
        'total_users'
    ];

    public $fillable = [
        'name',
        'status'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }

    public function getTotalUsersAttribute()
    {
        return $this->users()->select('id')->count();
    }
}
