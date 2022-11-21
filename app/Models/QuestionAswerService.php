<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAswerService extends Model
{
    use HasFactory;
    protected $table = 'question_aswer_service';
    protected $fillable = [
        'consulting_content',
        'created_date',
        'view',
        'type_of_service_id'
    ];
}
