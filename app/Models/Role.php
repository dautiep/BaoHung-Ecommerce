<?php

namespace App\Models;

use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, ScopeTrait;
    public $table = 'roles';



    public $fillable = [
        'permission',
        'name'
    ];

    public function setPermissionAttribute($value)
    {
        $this->attributes['permission'] = json_encode($value);
    }
}
