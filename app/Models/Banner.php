<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ScopeTrait;

class Banner extends Model
{
    use HasFactory, ScopeTrait;
    protected $table = 'banner';
    protected $fillable =    [
        'id',
        'title',
        'description',
        'href',
        'btn_title',
        'btn_href',
        'img_src',
        'img_alt',
        'status'
    ];
}
