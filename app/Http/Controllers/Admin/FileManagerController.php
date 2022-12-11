<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileManagerController extends Controller
{
    public function responseUpload($status = true, $filename, $type)
    {
        return response()->json([
            'status' => $status,
            'filename' => $filename,
        ]);
    }

    public function fileUpload(Request $request)
    {
        $helper = new FileManager();
        $upload = $helper->handle($request->file('file'));
        return $this->responseUpload(true, config('filesystems.disks.public.url') . '/uploads/' . $upload['file_name'], 'image/png');
    }
}
