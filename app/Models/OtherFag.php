<?php

namespace App\Models;

use App\Traits\Role;
use App\Traits\ScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherFag extends Model
{
    use HasFactory, ScopeTrait, Role;
    public $table = 'other_faqs';
    public $appends = [
        'users'
    ];
    public $fillable = [
        'content_to_consult',
        'consulting_content',
        'created_date',
        'status',
        'email',
        'phone',
        'type_of_service_id',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
