<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfService extends Model
{
    use HasFactory;
    public $keyType = 'string';
    public $table = 'type_of_service';
    public $primaryKey = 'id';
    public $incrementing = false;
    public $fillable = [
        'id',
        'name',
        'status',
        'created_date',
        'user_id'
    ];

    public function questionAswerService()
    {
        return $this->hasMany(QuestionAswerService::class, 'type_of_service_id', 'id');
    }
}
