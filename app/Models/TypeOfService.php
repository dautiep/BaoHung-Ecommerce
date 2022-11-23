<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfService extends Model
{
    use HasFactory;
    protected $table = 'type_of_service';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'created_date',
        'user_id'
    ];
}
