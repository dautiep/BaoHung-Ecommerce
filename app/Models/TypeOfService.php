<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfService extends Model
{
    use HasFactory;
    public $table = 'type_of_service';
    public $primaryKey = 'id';
    public $fillable = [
        'id',
        'name',
        'created_date',
        'user_id'
    ];
}
