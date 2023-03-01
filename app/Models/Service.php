<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $table = 'services';
    public $primaryKey = 'id';
    public $fillable = [
        'id',
        'name',
        'description',
        'status'
    ];
}
