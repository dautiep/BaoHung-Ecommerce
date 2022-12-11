<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManager
{
    public function getFileUrl($file)
    {
        $file = 'files/' . $file;

        return $file;
    }
    public function deleleFile($file_delete_exists, $fileSystem = 'public')
    {
        if (is_array($file_delete_exists)) {
            collect($file_delete_exists)->map(function ($item)  use ($fileSystem) {
                $this->removeFile($this->getFileUrl($item), $fileSystem);
            });
        }
    }

    public function removeFile($file, $fileSystem)
    {
        if (Storage::disk($fileSystem)->exists($file)) {
            Storage::disk($fileSystem)->delete($file);
        }
    }

    public function handle(UploadedFile $uploadedFile, $path = 'uploads', $assignNewName = true, $fileSystem = 'public')
    {

        if ($assignNewName) {
            $extension = $uploadedFile->getClientOriginalExtension();
            $fileName  = sprintf('%s.%s', strtotime(now()) .  Str::random(10), $extension);
        } else {
            $fileName = $uploadedFile->getClientOriginalName();
        }
        try {
            $uploadedFile->storeAs(
                $path,
                $fileName,
                $fileSystem
            );
            return [
                'file_name' => $fileName,
                'name' => $uploadedFile->getClientOriginalName(),
                'type' => $extension
            ];
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
