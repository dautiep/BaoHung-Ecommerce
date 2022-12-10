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
