<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'products';
    public $primaryKey = 'id';
    public $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'content',
        'price',
        'category_id',
        'image_url'
    ];
}
