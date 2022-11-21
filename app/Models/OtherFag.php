<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherFag extends Model
{
    use HasFactory;
    protected $table = 'other_faqs';
    protected $fillable = [
        'content_to_consult',
        'consulting_content',
        'created_date',
        'status',
        'email',
        'phone',
        'type_of_service_id'
    ];
}
