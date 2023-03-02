<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $table = 'categories';
    public $primaryKey = 'id';
    public $fillable = [
        'id',
        'name',
        'slug',
        'status'
    ];
}
