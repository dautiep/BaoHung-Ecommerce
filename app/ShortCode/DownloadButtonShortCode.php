<?php

namespace App\ShortCode;

use App\Repositories\QuestionAswerServiceRepository;
use Exception;

class DownloadButtonShortCode
{
    const short_code_name = 'button-download';
    /*
        Shortcode register in providers
    */
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $html = '';
        $attach_files = '';
        if (!empty(@$shortcode->data)) {
            $builder = $this->getAttachFiles($shortcode->data);
            $attach_files =  $builder->attach_files;
        }
        if (!empty($attach_files)) {
            $html = '<a class="btn btn-sm btn-info text-left" style="justify-content: flex-end" ' . "href='$attach_files'" . 'download>' . $this->getPathFile($attach_files) . '</a>';
        }
        return $html;
    }

    public function render($attributes, $show_content = true)
    {
        $html_answer = $show_content == true ? $attributes['consulting_content'] : '';
        $btn_download = '';
        if (@$attributes['attach_files'] && is_json(@$attributes['attach_files'])) {
            collect(json_decode(@$attributes['attach_files']))->map(function ($item) use (&$btn_download) {
                $btn_download = $btn_download .
                    '<a class="btn btn-sm btn-info text-right" style="justify-content: flex-start"  href=' . $this->getFileUrl($item) . '" download>' . @$item->name . '</a>';
            });
        }
        return $html_answer . $btn_download;
    }

    public function getFileUrl($file)
    {
        $file = config('filesystems.disks.public.url') . '/files/' . $file->url;

        return $file;
    }

    public function getAttachFiles($id)
    {
        return app(QuestionAswerServiceRepository::class)->find($id);
    }

    public function getPathFile($attach_files)
    {
        try {
            $fileInfo = pathinfo($attach_files);
            return $fileInfo['basename'];
        } catch (Exception $e) {
            return 'Tải về';
        }
    }
}
