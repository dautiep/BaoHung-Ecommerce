<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAswerService extends Model
{
    use HasFactory;
    public $table = 'question_aswer_service';
    public $fillable = [
        'consulting_content',
        'created_date',
        'view',
        'type_of_service_id'
    ];
}
