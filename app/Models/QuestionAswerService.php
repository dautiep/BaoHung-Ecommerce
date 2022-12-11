<?php

namespace App\Models;

use App\Helpers\FileManager;
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

    public function setAttachFilesAttribute($value)
    {
        $uploads = new FileManager();
        $files = [];
        collect($value)->map(function ($item) use (&$files, $uploads) {
            $context =  $uploads->handle($item, 'files');
            array_push($files, [
                'name' => $context['name'],
                'url' => $context['file_name'],
            ]);
        });

        if (!empty($this->attributes['attach_files']) && is_json($this->attributes['attach_files'])) {
            $files = array_merge(json_decode($this->attributes['attach_files'], true), $files);
        }
        $file_delete_exists = @json_decode(request()->get('file_delete', []), true);
        if (!empty($file_delete_exists) && @count($file_delete_exists) > 0) {
            $uploads->deleleFile($file_delete_exists);
            $files = collect($files)->filter(function ($item) use ($file_delete_exists) {
                return !in_array($item['url'], $file_delete_exists);
            });
        }


        $this->attributes['attach_files']  = json_encode($files);
    }

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
        $render = new DownloadButtonShortCode();
        return $render->render($this->attributes);
    }
}
