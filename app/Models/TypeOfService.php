<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfService extends Model
{
    use HasFactory;
    public $keyType = 'string';
    public $table = 'type_of_service';
    public $primaryKey = 'id';
    public $fillable = [
        'id',
        'name',
        'status',
        'created_date',
        'user_id'
    ];
}
