<?php

namespace App\Models;

use App\ShortCode\DownloadButtonShortCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Role;
use Shortcode;

class QuestionAswerService extends Model
{
    use HasFactory, Role;
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
        'status',
        'attach_files'
    ];

    public function typeOfServices()
    {
        return $this->belongsTo(TypeOfService::class, 'type_of_service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getContentAttribute()
    {
        $attach_files = $this->attributes['id'];

        $context = $this->attributes['consulting_content'];
        $replace = DownloadButtonShortCode::short_code_name . ' data=' . $attach_files;
        $result = str_replace(DownloadButtonShortCode::short_code_name, $replace, $context);
        return Shortcode::compile($result);
    }
}
