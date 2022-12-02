<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAswerService extends Model
{
    use HasFactory;
    public $table = 'question_aswer_service';
    public $keyType = 'string';
    public $primaryKey = 'id';
    public $incrementing = false;
    public $fillable = [
        'id',
        'question_content',
        'consulting_content',
        'created_date',
        'view',
        'type_of_service_id',
        'user_id',
        'status'
    ];

    public function typeOfServices()
    {
        return $this->belongsTo(TypeOfService::class, 'type_of_service_id', 'id');
    }
}
